<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Http;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Sunmi\Sunbay\Nexus\Constant\ApiConstants;
use Sunmi\Sunbay\Nexus\Exception\SunbayBusinessException;
use Sunmi\Sunbay\Nexus\Exception\SunbayNetworkException;
use Sunmi\Sunbay\Nexus\Model\Common\BaseResponse;
use Sunmi\Sunbay\Nexus\Util\IdGenerator;
use Sunmi\Sunbay\Nexus\Util\JsonUtil;

/**
 * HTTP client for Sunbay API
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class HttpClient
{
    private const HEADER_AUTHORIZATION = 'Authorization';
    private const HEADER_CONTENT_TYPE = 'Content-Type';
    private const HEADER_REQUEST_ID = 'X-Client-Request-Id';
    private const HEADER_TIMESTAMP = 'X-Timestamp';
    private const CONTENT_TYPE_JSON = 'application/json';
    private const RETRY_DELAY_BASE_MS = 1000;

    private string $apiKey;
    private string $baseUrl;
    private Client $httpClient;
    private int $maxRetries;
    private LoggerInterface $logger;

    public function __construct(
        string $apiKey,
        string $baseUrl,
        int $connectTimeout,
        int $readTimeout,
        int $maxRetries,
        ?int $maxTotal = null,
        ?int $maxPerRoute = null,
        ?LoggerInterface $logger = null
    ) {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->maxRetries = $maxRetries;
        $this->logger = $logger ?? new NullLogger();

        $config = [
            RequestOptions::TIMEOUT => $readTimeout / 1000,
            RequestOptions::CONNECT_TIMEOUT => $connectTimeout / 1000,
            RequestOptions::HTTP_ERRORS => false,
        ];

        // Connection pool configuration is handled by Guzzle automatically
        // maxTotal and maxPerRoute are kept for future use if needed

        $this->httpClient = new Client($config);
    }

    /**
     * Execute POST request
     *
     * @param string $path API path
     * @param object $requestBody request body object
     * @param string $responseType response type class name
     * @return BaseResponse response object
     */
    public function post(string $path, object $requestBody, string $responseType): BaseResponse
    {
        $url = $this->baseUrl . $path;
        $requestJson = JsonUtil::toJson($requestBody);

        $request = new Request(
            ApiConstants::HTTP_METHOD_POST,
            $url,
            $this->buildHeaders(ApiConstants::HTTP_METHOD_POST),
            $requestJson
        );

        return $this->executeRequest($request, $responseType, false);
    }

    /**
     * Execute GET request
     *
     * @param string $path API path
     * @param object|null $request request object with query parameters
     * @param string $responseType response type class name
     * @return BaseResponse response object
     */
    public function get(string $path, ?object $request, string $responseType): BaseResponse
    {
        $url = $this->baseUrl . $path;

        // Build query parameters from request object
        $queryParams = [];
        if ($request !== null) {
            $queryParams = $this->extractQueryParams($request);
        }

        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }

        $httpRequest = new Request(
            ApiConstants::HTTP_METHOD_GET,
            $url,
            $this->buildHeaders(ApiConstants::HTTP_METHOD_GET)
        );

        return $this->executeRequest($httpRequest, $responseType, true);
    }

    /**
     * Extract query parameters from request object
     *
     * @param object $request request object
     * @return array query parameters
     */
    private function extractQueryParams(object $request): array
    {
        $params = [];
        $reflection = new \ReflectionClass($request);

        foreach ($reflection->getMethods() as $method) {
            $methodName = $method->getName();
            if (strpos($methodName, 'get') === 0
                && strlen($methodName) > ApiConstants::GETTER_METHOD_PREFIX_LENGTH
                && $method->getNumberOfParameters() === 0
                && $methodName !== 'getClass'
            ) {
                try {
                    $value = $method->invoke($request);
                    if ($value !== null) {
                        $paramName = $this->convertMethodNameToParamName($methodName);
                        $params[$paramName] = (string)$value;
                    }
                } catch (\Exception $e) {
                    // Ignore reflection errors
                }
            }
        }

        return $params;
    }

    /**
     * Convert getter method name to parameter name
     * e.g., getAppId -> appId, getTransactionId -> transactionId
     *
     * @param string $methodName method name
     * @return string parameter name
     */
    private function convertMethodNameToParamName(string $methodName): string
    {
        if (strpos($methodName, 'get') === 0 && strlen($methodName) > ApiConstants::GETTER_METHOD_PREFIX_LENGTH) {
            $rest = substr($methodName, 3);
            return lcfirst($rest);
        }
        return $methodName;
    }

    /**
     * Build common headers
     *
     * @param string $method HTTP method
     * @return array headers
     */
    private function buildHeaders(string $method): array
    {
        $headers = [
            self::HEADER_AUTHORIZATION => ApiConstants::AUTHORIZATION_BEARER_PREFIX . $this->apiKey,
            self::HEADER_REQUEST_ID => IdGenerator::generateRequestId(),
            self::HEADER_TIMESTAMP => (string)(int)(microtime(true) * 1000),
        ];

        if (strtoupper($method) === ApiConstants::HTTP_METHOD_POST) {
            $headers[self::HEADER_CONTENT_TYPE] = self::CONTENT_TYPE_JSON;
        }

        return $headers;
    }

    /**
     * Execute HTTP request with retry logic
     *
     * @param \Psr\Http\Message\RequestInterface $request HTTP request
     * @param string $responseType response type class name
     * @param bool $retryable whether the request is retryable
     * @return BaseResponse response object
     */
    private function executeRequest(\Psr\Http\Message\RequestInterface $request, string $responseType, bool $retryable): BaseResponse
    {
        $attempts = 0;
        $maxAttempts = $retryable ? $this->maxRetries : 1;

        while ($attempts < $maxAttempts) {
            $attempts++;
            try {
                return $this->doExecute($request, $responseType);
            } catch (SunbayNetworkException $e) {
                if (!$retryable || $attempts >= $maxAttempts) {
                    // Log final failure
                    if ($this->logger !== null) {
                        $this->logger->warning("Request failed after {$attempts} attempts: {$e->getMessage()}");
                    }
                    throw $e;
                }

                // Log retry
                if ($this->logger !== null) {
                    $this->logger->debug("Request failed, retrying ({$attempts}/{$maxAttempts}) after delay: {$e->getMessage()}");
                }

                // Retry after delay
                usleep(self::RETRY_DELAY_BASE_MS * 1000 * $attempts);
            }
        }

        throw new SunbayNetworkException("Request failed after {$maxAttempts} attempts", true);
    }

    /**
     * Execute HTTP request
     *
     * @param \Psr\Http\Message\RequestInterface $request HTTP request
     * @param string $responseType response type class name
     * @return BaseResponse response object
     */
    private function doExecute(\Psr\Http\Message\RequestInterface $request, string $responseType): BaseResponse
    {
        $requestUrl = (string)$request->getUri();
        $requestMethod = $request->getMethod();
        $requestBody = $this->extractRequestBody($request);

        // Log request
        if ($this->logger !== null) {
            if ($requestBody !== null && $requestBody !== '') {
                $this->logger->info("Request {$requestMethod} {$requestUrl} - Body: {$requestBody}");
            } else {
                $this->logger->info("Request {$requestMethod} {$requestUrl}");
            }
        }

        try {
            $response = $this->httpClient->send($request);
            $statusCode = $response->getStatusCode();
            $responseBody = $response->getBody()->getContents();

            // Log response
            if ($this->logger !== null) {
                $this->logger->info("Response {$requestMethod} {$requestUrl} - Status: {$statusCode}, Body: {$responseBody}");
            }

            if ($statusCode >= ApiConstants::HTTP_STATUS_OK_START && $statusCode < ApiConstants::HTTP_STATUS_OK_END) {
                if (empty($responseBody)) {
                    throw new SunbayNetworkException('Empty response body', false);
                }

                $result = $this->parseResponse($responseBody, $responseType);
                if ($result === null) {
                    throw new SunbayNetworkException('Failed to parse response body', false);
                }

                if (!$result->isSuccess()) {
                    // Log API error
                    if ($this->logger !== null) {
                        $this->logger->error(
                            "API error {$requestMethod} {$requestUrl} - code: {$result->getCode()}, msg: {$result->getMsg()}, traceId: {$result->getTraceId()}"
                        );
                    }
                    throw new SunbayBusinessException(
                        $result->getCode() ?? ApiConstants::ERROR_CODE_PARAMETER_ERROR,
                        $result->getMsg() ?? 'Unknown error',
                        $result->getTraceId()
                    );
                }

                return $result;
            } else {
                $errorMessage = $this->buildErrorMessage($statusCode, $responseBody);
                // Log HTTP error
                if ($this->logger !== null) {
                    $this->logger->error("HTTP error {$requestMethod} {$requestUrl} - Status: {$statusCode}, Message: {$errorMessage}");
                }
                throw new SunbayNetworkException($errorMessage, false);
            }
        } catch (ConnectException $e) {
            // Log network error
            if ($this->logger !== null) {
                $this->logger->warning("Network error {$requestMethod} {$requestUrl}: {$e->getMessage()}");
            }
            throw new SunbayNetworkException('Network error: ' . $e->getMessage(), true, $e);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $responseBody = $e->getResponse()->getBody()->getContents();
                $errorMessage = $this->buildErrorMessage($statusCode, $responseBody);
                throw new SunbayNetworkException($errorMessage, false, $e);
            }
            throw new SunbayNetworkException('Request error: ' . $e->getMessage(), true, $e);
        } catch (GuzzleException $e) {
            throw new SunbayNetworkException('HTTP error: ' . $e->getMessage(), true, $e);
        }
    }

    /**
     * Parse response with data field support
     * API returns: {"code":"0","msg":"Success","data":{...},"traceId":"..."}
     * Need to extract data field and merge with base response
     *
     * @param string $responseBody response body JSON string
     * @param string $responseType response type class name
     * @return BaseResponse|null parsed response object
     */
    private function parseResponse(string $responseBody, string $responseType): ?BaseResponse
    {
        try {
            $data = json_decode($responseBody, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return JsonUtil::fromJson($responseBody, $responseType);
            }

            // Extract base fields (code, msg, traceId)
            $code = $data[ApiConstants::JSON_FIELD_CODE] ?? null;
            $msg = $data[ApiConstants::JSON_FIELD_MSG] ?? null;
            $traceId = $data[ApiConstants::JSON_FIELD_TRACE_ID] ?? null;

            // Extract data field if exists
            $dataNode = $data[ApiConstants::JSON_FIELD_DATA] ?? null;

            // Create response object
            if ($dataNode !== null && !empty($dataNode)) {
                // Merge data field with base response
                $dataJson = json_encode($dataNode);
                $result = JsonUtil::fromJson($dataJson, $responseType);
            } else {
                // No data field, parse entire response
                $result = JsonUtil::fromJson($responseBody, $responseType);
            }

            // Set base fields
            if ($result !== null) {
                $result->setCode($code);
                $result->setMsg($msg);
                $result->setTraceId($traceId);
            }

            return $result;
        } catch (\Exception $e) {
            // Fallback to direct parsing
            return JsonUtil::fromJson($responseBody, $responseType);
        }
    }

    /**
     * Extract request body from HTTP request
     *
     * @param \Psr\Http\Message\RequestInterface $request HTTP request
     * @return string|null request body string, or null if not available
     */
    private function extractRequestBody(\Psr\Http\Message\RequestInterface $request): ?string
    {
        $body = $request->getBody();
        if ($body->getSize() > 0) {
            $body->rewind();
            $content = $body->getContents();
            $body->rewind();
            return $content;
        }
        return null;
    }

    /**
     * Build error message from HTTP status code and response body
     *
     * @param int $statusCode HTTP status code
     * @param string $responseBody response body
     * @return string error message
     */
    private function buildErrorMessage(int $statusCode, string $responseBody): string
    {
        $message = "HTTP {$statusCode}";

        if ($statusCode >= ApiConstants::HTTP_STATUS_CLIENT_ERROR_START
            && $statusCode < ApiConstants::HTTP_STATUS_CLIENT_ERROR_END
        ) {
            $message .= ' (Client Error)';
        } elseif ($statusCode >= ApiConstants::HTTP_STATUS_SERVER_ERROR_START) {
            $message .= ' (Server Error)';
        }

        if (!empty($responseBody)) {
            $message .= ' - ' . $responseBody;
        }

        return $message;
    }

    /**
     * Close HTTP client and release resources
     */
    public function close(): void
    {
        // Guzzle client doesn't need explicit close in PHP
        // Connection pool is managed automatically
    }
}


