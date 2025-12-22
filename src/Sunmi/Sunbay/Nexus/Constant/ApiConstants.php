<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Constant;

/**
 * API constants
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class ApiConstants
{
    /**
     * Parameter error code (C17)
     */
    public const ERROR_CODE_PARAMETER_ERROR = 'C17';

    /**
     * HTTP methods
     */
    public const HTTP_METHOD_POST = 'POST';
    public const HTTP_METHOD_GET = 'GET';

    /**
     * HTTP status codes
     */
    public const HTTP_STATUS_OK_START = 200;
    public const HTTP_STATUS_OK_END = 300;
    public const HTTP_STATUS_CLIENT_ERROR_START = 400;
    public const HTTP_STATUS_CLIENT_ERROR_END = 500;
    public const HTTP_STATUS_SERVER_ERROR_START = 500;

    /**
     * Response success code
     */
    public const RESPONSE_SUCCESS_CODE = '0';

    /**
     * Authorization header prefix
     */
    public const AUTHORIZATION_BEARER_PREFIX = 'Bearer ';

    /**
     * JSON field names
     */
    public const JSON_FIELD_CODE = 'code';
    public const JSON_FIELD_MSG = 'msg';
    public const JSON_FIELD_DATA = 'data';
    public const JSON_FIELD_TRACE_ID = 'traceId';

    /**
     * Getter method name prefix length
     */
    public const GETTER_METHOD_PREFIX_LENGTH = 3;

    /**
     * Semi-integration API path prefix
     */
    public const SEMI_INTEGRATION_PREFIX = '/v1/semi-integration';

    /**
     * Common API path prefix
     */
    public const COMMON_PREFIX = '/v1';

    /**
     * Semi-integration transaction API paths
     */
    public const PATH_SALE = self::SEMI_INTEGRATION_PREFIX . '/transaction/sale';
    public const PATH_AUTH = self::SEMI_INTEGRATION_PREFIX . '/transaction/auth';
    public const PATH_FORCED_AUTH = self::SEMI_INTEGRATION_PREFIX . '/transaction/forced-auth';
    public const PATH_INCREMENTAL_AUTH = self::SEMI_INTEGRATION_PREFIX . '/transaction/incremental-auth';
    public const PATH_POST_AUTH = self::SEMI_INTEGRATION_PREFIX . '/transaction/post-auth';
    public const PATH_REFUND = self::SEMI_INTEGRATION_PREFIX . '/transaction/refund';
    public const PATH_VOID = self::SEMI_INTEGRATION_PREFIX . '/transaction/void';
    public const PATH_ABORT = self::SEMI_INTEGRATION_PREFIX . '/transaction/abort';
    public const PATH_TIP_ADJUST = self::SEMI_INTEGRATION_PREFIX . '/transaction/tip-adjust';
    public const PATH_QUERY = self::COMMON_PREFIX . '/transaction/query';

    /**
     * Semi-integration settlement API paths
     */
    public const PATH_BATCH_CLOSE = self::SEMI_INTEGRATION_PREFIX . '/settlement/batch-close';

    private function __construct()
    {
    }
}

