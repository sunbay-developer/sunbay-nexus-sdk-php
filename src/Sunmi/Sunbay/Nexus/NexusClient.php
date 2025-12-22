<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus;

use Sunmi\Sunbay\Nexus\Constant\ApiConstants;
use Sunmi\Sunbay\Nexus\Exception\SunbayBusinessException;
use Sunmi\Sunbay\Nexus\Http\HttpClient;
use Sunmi\Sunbay\Nexus\Model\Request\AbortRequest;
use Sunmi\Sunbay\Nexus\Model\Request\AuthRequest;
use Sunmi\Sunbay\Nexus\Model\Request\BatchCloseRequest;
use Sunmi\Sunbay\Nexus\Model\Request\ForcedAuthRequest;
use Sunmi\Sunbay\Nexus\Model\Request\IncrementalAuthRequest;
use Sunmi\Sunbay\Nexus\Model\Request\PostAuthRequest;
use Sunmi\Sunbay\Nexus\Model\Request\QueryRequest;
use Sunmi\Sunbay\Nexus\Model\Request\RefundRequest;
use Sunmi\Sunbay\Nexus\Model\Request\SaleRequest;
use Sunmi\Sunbay\Nexus\Model\Request\TipAdjustRequest;
use Sunmi\Sunbay\Nexus\Model\Request\VoidRequest;
use Sunmi\Sunbay\Nexus\Model\Response\AbortResponse;
use Sunmi\Sunbay\Nexus\Model\Response\AuthResponse;
use Sunmi\Sunbay\Nexus\Model\Response\BatchCloseResponse;
use Sunmi\Sunbay\Nexus\Model\Response\ForcedAuthResponse;
use Sunmi\Sunbay\Nexus\Model\Response\IncrementalAuthResponse;
use Sunmi\Sunbay\Nexus\Model\Response\PostAuthResponse;
use Sunmi\Sunbay\Nexus\Model\Response\QueryResponse;
use Sunmi\Sunbay\Nexus\Model\Response\RefundResponse;
use Sunmi\Sunbay\Nexus\Model\Response\SaleResponse;
use Sunmi\Sunbay\Nexus\Model\Response\TipAdjustResponse;
use Sunmi\Sunbay\Nexus\Model\Response\VoidResponse;

/**
 * Sunbay SDK main client
 *
 * This client is thread-safe and can be safely used by multiple threads.
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class NexusClient
{
    public const DEFAULT_BASE_URL = 'https://open.sunbay.us';
    public const DEFAULT_CONNECT_TIMEOUT = 30000;
    public const DEFAULT_READ_TIMEOUT = 60000;
    public const DEFAULT_MAX_RETRIES = 3;
    public const DEFAULT_MAX_TOTAL = 200;
    public const DEFAULT_MAX_PER_ROUTE = 20;

    private HttpClient $httpClient;

    public function __construct(Builder $builder)
    {
        $this->httpClient = new HttpClient(
            $builder->apiKey,
            $builder->baseUrl,
            $builder->connectTimeout,
            $builder->readTimeout,
            $builder->maxRetries,
            $builder->maxTotal,
            $builder->maxPerRoute,
            $builder->logger
        );
    }

    /**
     * Sale transaction
     *
     * @param SaleRequest $request sale request
     * @return SaleResponse sale response
     */
    public function sale(SaleRequest $request): SaleResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_SALE, $request, SaleResponse::class);
    }

    /**
     * Authorization (pre-auth)
     *
     * @param AuthRequest $request auth request
     * @return AuthResponse auth response
     */
    public function auth(AuthRequest $request): AuthResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_AUTH, $request, AuthResponse::class);
    }

    /**
     * Query transaction
     *
     * @param QueryRequest $request query request
     * @return QueryResponse query response
     */
    public function query(QueryRequest $request): QueryResponse
    {
        return $this->httpClient->get(ApiConstants::PATH_QUERY, $request, QueryResponse::class);
    }

    /**
     * Refund
     *
     * @param RefundRequest $request refund request
     * @return RefundResponse refund response
     */
    public function refund(RefundRequest $request): RefundResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_REFUND, $request, RefundResponse::class);
    }

    /**
     * Void transaction
     *
     * @param VoidRequest $request void request
     * @return VoidResponse void response
     */
    public function voidTransaction(VoidRequest $request): VoidResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_VOID, $request, VoidResponse::class);
    }

    /**
     * Forced authorization
     *
     * @param ForcedAuthRequest $request forced auth request
     * @return ForcedAuthResponse forced auth response
     */
    public function forcedAuth(ForcedAuthRequest $request): ForcedAuthResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_FORCED_AUTH, $request, ForcedAuthResponse::class);
    }

    /**
     * Incremental authorization
     *
     * @param IncrementalAuthRequest $request incremental auth request
     * @return IncrementalAuthResponse incremental auth response
     */
    public function incrementalAuth(IncrementalAuthRequest $request): IncrementalAuthResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_INCREMENTAL_AUTH, $request, IncrementalAuthResponse::class);
    }

    /**
     * Post authorization (pre-auth completion)
     *
     * @param PostAuthRequest $request post auth request
     * @return PostAuthResponse post auth response
     */
    public function postAuth(PostAuthRequest $request): PostAuthResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_POST_AUTH, $request, PostAuthResponse::class);
    }

    /**
     * Abort transaction
     *
     * @param AbortRequest $request abort request
     * @return AbortResponse abort response
     */
    public function abort(AbortRequest $request): AbortResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_ABORT, $request, AbortResponse::class);
    }

    /**
     * Tip adjust
     *
     * @param TipAdjustRequest $request tip adjust request
     * @return TipAdjustResponse tip adjust response
     */
    public function tipAdjust(TipAdjustRequest $request): TipAdjustResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_TIP_ADJUST, $request, TipAdjustResponse::class);
    }

    /**
     * Batch close
     *
     * @param BatchCloseRequest $request batch close request
     * @return BatchCloseResponse batch close response
     */
    public function batchClose(BatchCloseRequest $request): BatchCloseResponse
    {
        return $this->httpClient->post(ApiConstants::PATH_BATCH_CLOSE, $request, BatchCloseResponse::class);
    }

    /**
     * Close client and release resources
     */
    public function close(): void
    {
        $this->httpClient->close();
    }

    /**
     * Builder for NexusClient
     */
    public static function builder(): Builder
    {
        return new Builder();
    }
}

/**
 * Builder for NexusClient
 */
class Builder
{
    public string $apiKey;
    public string $baseUrl = NexusClient::DEFAULT_BASE_URL;
    public int $connectTimeout = NexusClient::DEFAULT_CONNECT_TIMEOUT;
    public int $readTimeout = NexusClient::DEFAULT_READ_TIMEOUT;
    public int $maxRetries = NexusClient::DEFAULT_MAX_RETRIES;
    public ?int $maxTotal = NexusClient::DEFAULT_MAX_TOTAL;
    public ?int $maxPerRoute = NexusClient::DEFAULT_MAX_PER_ROUTE;
    public ?\Psr\Log\LoggerInterface $logger = null;

    /**
     * Set API key
     *
     * @param string $apiKey API key
     * @return self
     */
    public function apiKey(string $apiKey): self
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Set base URL
     *
     * @param string $baseUrl base URL
     * @return self
     */
    public function baseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * Set connect timeout
     *
     * @param int $connectTimeout connect timeout in milliseconds
     * @return self
     */
    public function connectTimeout(int $connectTimeout): self
    {
        $this->connectTimeout = $connectTimeout;
        return $this;
    }

    /**
     * Set read timeout
     *
     * @param int $readTimeout read timeout in milliseconds
     * @return self
     */
    public function readTimeout(int $readTimeout): self
    {
        $this->readTimeout = $readTimeout;
        return $this;
    }

    /**
     * Set max retries
     *
     * @param int $maxRetries max retries for GET requests
     * @return self
     */
    public function maxRetries(int $maxRetries): self
    {
        $this->maxRetries = $maxRetries;
        return $this;
    }

    /**
     * Set maximum total connections in the connection pool
     *
     * @param int $maxTotal maximum total connections (default: 200)
     * @return self
     */
    public function maxTotal(int $maxTotal): self
    {
        $this->maxTotal = $maxTotal;
        return $this;
    }

    /**
     * Set maximum connections per route in the connection pool
     *
     * @param int $maxPerRoute maximum connections per route (default: 20)
     * @return self
     */
    public function maxPerRoute(int $maxPerRoute): self
    {
        $this->maxPerRoute = $maxPerRoute;
        return $this;
    }

    /**
     * Set logger for HTTP requests and responses
     *
     * @param \Psr\Log\LoggerInterface|null $logger PSR-3 logger instance
     * @return self
     */
    public function logger(?\Psr\Log\LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * Build NexusClient instance
     *
     * @return NexusClient
     */
    public function build(): NexusClient
    {
        if (empty($this->apiKey)) {
            throw new SunbayBusinessException(
                ApiConstants::ERROR_CODE_PARAMETER_ERROR,
                'API key cannot be null or empty',
                null
            );
        }
        return new NexusClient($this);
    }
}

