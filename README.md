# Sunbay Nexus PHP SDK

Official PHP SDK for Sunbay Nexus Payment Platform

**Current Version:** 1.0.1

## Features

- ✅ Simple and intuitive API
- ✅ Builder pattern for easy request construction
- ✅ Support PHP 8.1+
- ✅ Automatic authentication
- ✅ Automatic retry for GET requests
- ✅ Comprehensive exception handling
- ✅ Minimal dependencies

## Installation

Please visit [https://packagist.org/packages/sunmi/sunbay-nexus-sdk-php](https://packagist.org/packages/sunmi/sunbay-nexus-sdk-php) to get the latest version.

Add the following to your `composer.json`:

```json
{
    "require": {
        "sunmi/sunbay-nexus-sdk-php": "^1.0"
    }
}
```

Then run:

```bash
composer install
```

## Quick Start

### 1. Initialize Client

The `NexusClient` is thread-safe and can be reused across multiple threads.

```php
<?php
use Sunmi\Sunbay\Nexus\NexusClient;

// Create client
$client = NexusClient::builder()
    ->apiKey('your_api_key_here')
    ->baseUrl('https://open.sunbay.us')
    ->build();

// Use the client throughout your application
// The client is reusable and thread-safe
```

### 2. Sale Transaction

```php
<?php
use Sunmi\Sunbay\Nexus\NexusClient;
use Sunmi\Sunbay\Nexus\Exception\SunbayBusinessException;
use Sunmi\Sunbay\Nexus\Exception\SunbayNetworkException;
use Sunmi\Sunbay\Nexus\Model\Common\SaleAmount;
use Sunmi\Sunbay\Nexus\Model\Request\SaleRequest;
use Sunmi\Sunbay\Nexus\Model\Response\SaleResponse;

// Assume client is already initialized
// $client = ... (from step 1)

// Build amount using Builder pattern
$amount = SaleAmount::builder()
    ->orderAmount(100.00)
    ->pricingCurrency('USD')
    ->build();

// Build sale request using Builder pattern
$request = SaleRequest::builder()
    ->appId('app_123456')
    ->merchantId('mch_789012')
    ->referenceOrderId('ORDER20231119001')
    ->transactionRequestId('PAY_REQ_' . time())
    ->amount($amount)
    ->description('Product purchase')
    ->terminalSn('T1234567890')
    ->build();

// Execute transaction
try {
    $response = $client->sale($request);
    if ($response->isSuccess()) {
        echo "Transaction ID: " . $response->getTransactionId() . "\n";
    } else {
        echo "Error: " . $response->getMsg() . "\n";
    }
} catch (SunbayNetworkException $e) {
    echo "Network Error: " . $e->getMessage() . "\n";
} catch (SunbayBusinessException $e) {
    echo "API Error: " . $e->getErrorCode() . " - " . $e->getMessage() . "\n";
}
```

## API Methods

All request classes support Builder pattern for easy construction.

### Transaction APIs

- `sale(SaleRequest)` - Sale transaction
- `auth(AuthRequest)` - Authorization (pre-auth)
- `forcedAuth(ForcedAuthRequest)` - Forced authorization
- `incrementalAuth(IncrementalAuthRequest)` - Incremental authorization
- `postAuth(PostAuthRequest)` - Post authorization (pre-auth completion)
- `refund(RefundRequest)` - Refund
- `voidTransaction(VoidRequest)` - Void transaction
- `abort(AbortRequest)` - Abort transaction
- `tipAdjust(TipAdjustRequest)` - Tip adjust

### Query APIs

- `query(QueryRequest)` - Query transaction

### Settlement APIs

- `batchClose(BatchCloseRequest)` - Batch close

## Response Objects

All response objects extend `BaseResponse` and provide the following common methods:

- `isSuccess()` - Check if the response is successful (code is "0")
- `getCode()` - Get response code
- `getMsg()` - Get response message
- `getTraceId()` - Get trace ID for troubleshooting

Transaction responses (e.g., `SaleResponse`, `AuthResponse`) also provide:
- `getTransactionId()` - Get transaction ID
- `getReferenceOrderId()` - Get reference order ID
- `getTransactionRequestId()` - Get transaction request ID

## Exception Handling

The SDK throws two types of exceptions:

- **SunbayNetworkException**: Network-related errors (connection timeout, network error, etc.)
- **SunbayBusinessException**: Business logic errors (parameter validation, API business errors, etc.)

Always catch `SunbayNetworkException` before `SunbayBusinessException`:

```php
try {
    $response = $client->sale($request);
    // Handle success
} catch (SunbayNetworkException $e) {
    // Network exception (e.g., connection timeout, network error)
    echo "Network Error: " . $e->getMessage() . "\n";
    if ($e->isRetryable()) {
        // Can retry
    }
} catch (SunbayBusinessException $e) {
    // Business exception (e.g., insufficient funds, parameter error)
    echo "API Error: " . $e->getErrorCode() . " - " . $e->getMessage() . "\n";
    if ($e->getTraceId() !== null) {
        echo "Trace ID: " . $e->getTraceId() . "\n";
    }
}
```

## Configuration

```php
use Psr\Log\LoggerInterface;

$client = NexusClient::builder()
    ->apiKey('sk_test_xxx')
    ->baseUrl('https://open.sunbay.us')  // Default: https://open.sunbay.us
    ->connectTimeout(30000)               // Default: 30000ms (30 seconds)
    ->readTimeout(60000)                   // Default: 60000ms (60 seconds)
    ->maxRetries(3)                        // Default: 3 retries for GET requests
    ->maxTotal(200)                        // Default: 200 (max total connections in pool)
    ->maxPerRoute(20)                      // Default: 20 (max connections per route)
    ->logger($logger)                      // Optional: PSR-3 logger for request/response logging
    ->build();
```

## Logging

The SDK supports PSR-3 compatible loggers for recording HTTP requests and responses. You can use any PSR-3 compatible logging library:

```php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('sunbay-sdk');
$logger->pushHandler(new StreamHandler('path/to/your.log', Logger::INFO));

$client = NexusClient::builder()
    ->apiKey('sk_test_xxx')
    ->logger($logger)  // Optional: omit to disable logging
    ->build();
```

## Requirements

- PHP 8.1 or higher
- Guzzle HTTP 7.5+
- PSR-3 Logger (optional)

## License

MIT License

