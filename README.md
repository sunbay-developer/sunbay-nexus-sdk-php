# Sunbay Nexus PHP SDK

Official PHP SDK for Sunbay Nexus Payment Platform

**Current Version:** 1.0.5

## Features

- ✅ Simple and intuitive API
- ✅ PHP 8.1+ named arguments for clean, readable construction
- ✅ Fluent setter & Builder pattern also supported
- ✅ Automatic authentication
- ✅ Automatic retry for GET requests
- ✅ HTTP connection pool with configurable limits
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

The `NexusClient` is thread-safe and **should be instantiated once** and reused throughout
your application's lifecycle. Each instance holds its own HTTP connection pool; creating a
new client per request wastes connections and defeats connection reuse.

**Builder pattern:**

```php
<?php
use Sunmi\Sunbay\Nexus\NexusClient;

$client = NexusClient::builder()
    ->apiKey('your_api_key_here')
    ->baseUrl('https://open.sunbay.us')      // optional, defaults to https://open.sunbay.us
    ->connectTimeout(10000)                   // optional, default 10000ms
    ->readTimeout(30000)                      // optional, default 30000ms
    ->maxRetries(3)                           // optional, GET retry count, default 3
    ->maxTotal(200)                           // optional, max pool connections, default 200
    ->maxPerRoute(200)                        // optional, max connections per host, default 200
    ->build();
```

### 2. Sale Transaction

> **Important:** All amount fields use the smallest currency unit (integer).  
> For example: 100.00 USD = 10000 cents.

```php
<?php
use Sunmi\Sunbay\Nexus\Model\Common\SaleAmount;
use Sunmi\Sunbay\Nexus\Model\Request\SaleRequest;
use Sunmi\Sunbay\Nexus\Exception\SunbayBusinessException;
use Sunmi\Sunbay\Nexus\Exception\SunbayNetworkException;

// Build amount (smallest currency unit)
$amount = new SaleAmount(
    orderAmount: 10000,       // 100.00 USD = 10000 cents
    priceCurrency: 'USD'
);

// Build sale request
$request = new SaleRequest(
    appId: 'app_123456',
    merchantId: 'mch_789012',
    referenceOrderId: 'ORDER20231119001',
    transactionRequestId: 'PAY_REQ_' . time(),
    amount: $amount,
    description: 'Product purchase',
    terminalSn: 'T1234567890'
);

try {
    // Execute transaction
    // SDK automatically throws SunbayBusinessException when code != "0"
    // If we reach here, the response is guaranteed successful
    $response = $client->sale($request);

    echo "Transaction ID: " . $response->getTransactionId() . "\n";
    echo "Reference Order ID: " . $response->getReferenceOrderId() . "\n";
} catch (SunbayNetworkException $e) {
    // Network error
    echo "Network Error: " . $e->getMessage() . "\n";
    if ($e->isRetryable()) {
        echo "This error is retryable\n";
    }
} catch (SunbayBusinessException $e) {
    // Business error
    echo "API Error: " . $e->getErrorCode() . " - " . $e->getMessage() . "\n";
    if ($e->getTraceId()) {
        echo "Trace ID: " . $e->getTraceId() . "\n";
    }
}
```

## API Methods

All request classes support **named arguments** (recommended), fluent setters, and Builder pattern.

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

- `batchQuery(BatchQueryRequest)` - Batch query
- `batchClose(BatchCloseRequest)` - Batch close
- `batchCloseList(BatchCloseListRequest)` - Query settled batch list

### Merchant APIs

- `merchantQuery(MerchantQueryRequest)` - Query merchant information
- `merchantTerminalsQuery(MerchantTerminalsQueryRequest)` - Query merchant terminals (token-based pagination, max 100 per page)

### Online Checkout APIs

- `createCheckoutSession(CreateCheckoutSessionRequest)` - Create hosted payment page session
- `expireCheckoutSession(ExpireCheckoutSessionRequest)` - Expire checkout session
- `checkoutSale(CheckoutSaleRequest)` - Direct online checkout sale (Google Pay / Apple Pay)
- `onlineRefund(OnlineRefundRequest)` - Online refund

## Response Objects

All response objects extend `BaseResponse` and provide the following common methods:

- `isSuccess()` - Check if the response is successful (code is "0"). Note: If code is not "0", a `SunbayBusinessException` will be thrown automatically, so you typically don't need to check this manually.
- `getCode()` - Get response code
- `getMsg()` - Get response message
- `getTraceId()` - Get trace ID for troubleshooting

**Important:** The SDK automatically throws `SunbayBusinessException` when the API returns a non-zero code. If your code reaches the response handling without catching an exception, the response is guaranteed to be successful (code = "0").

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
    ->connectTimeout(10000)               // Default: 10000ms (10 seconds)
    ->readTimeout(30000)                  // Default: 30000ms (30 seconds)
    ->maxRetries(3)                       // Default: 3 retries for GET requests
    ->maxTotal(200)                       // Default: 200 (max total connections in pool)
    ->maxPerRoute(200)                    // Default: 200 (max connections per host)
    ->logger($logger)                     // Optional: PSR-3 logger for request/response logging
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

## Enums

The SDK provides type-safe enums for common payment-related values. These enums help prevent invalid values and provide better IDE support:

### Available Enums

- **`PaymentCategory`** - Payment method categories (CARD, CARD_CREDIT, CARD_DEBIT, QR_MPM, QR_CPM)
- **`TransactionStatus`** - Transaction status codes returned by API (I=INITIAL, P=PROCESSING, S=SUCCESS, F=FAIL, C=CLOSED)
- **`TransactionType`** - Transaction types (SALE, AUTH, FORCED_AUTH, INCREMENTAL, POST_AUTH, REFUND, VOID)
- **`CardNetworkType`** - Card network types (CREDIT, DEBIT, EBT, EGC, UNKNOWN)
- **`EntryMode`** - Card entry modes (MANUAL, SWIPE, FALLBACK_SWIPE, CONTACT, CONTACTLESS)
- **`AuthenticationMethod`** - Authentication methods (NOT_AUTHENTICATED, PIN, OFFLINE_PIN, BY_PASS, SIGNATURE)
- **`SignatureEntryLocation`** - Signature entry locations (ON_SCREEN, ON_RECEIPT)

### Usage Example

```php
use Sunmi\Sunbay\Nexus\Enum\PaymentCategory;
use Sunmi\Sunbay\Nexus\Enum\TransactionStatus;
use Sunmi\Sunbay\Nexus\Model\Common\PaymentMethodInfo;
use Sunmi\Sunbay\Nexus\Model\Response\QueryResponse;

// Use enum for type safety when building requests
$paymentMethod = new PaymentMethodInfo(
    category: PaymentCategory::CARD->value
);

// When reading responses, validate enum values
$queryResponse = $client->query($request);
if ($queryResponse->getTransactionStatus() !== null) {
    $statusCode = $queryResponse->getTransactionStatus();
    // Validate against enum (API returns code like "I", "P", "S", "F", "C")
    $validStatuses = array_map(fn($case) => $case->value, TransactionStatus::cases());
    if (in_array($statusCode, $validStatuses)) {
        // Status is valid
    }
}

// Enums work seamlessly with JSON serialization
$json = json_encode(['category' => PaymentCategory::QR_MPM->value]);
// Output: {"category":"QR-MPM"}
```

**Note:** 
- While enums provide type safety, the SDK maintains backward compatibility with string values. You can continue using strings (e.g., `"CARD"`) or use enums for better type safety.
- For `TransactionStatus`, the API returns single-character codes (I, P, S, F, C) rather than full names. The enum values match these codes.

## Requirements

- PHP 8.1 or higher
- Guzzle HTTP 7.5+
- PSR-3 Logger (optional)

## License

MIT License
