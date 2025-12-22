<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Tests\Unit;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Sunmi\Sunbay\Nexus\Exception\SunbayBusinessException;
use Sunmi\Sunbay\Nexus\Exception\SunbayNetworkException;
use Sunmi\Sunbay\Nexus\NexusClient;
use Sunmi\Sunbay\Nexus\Model\Common\SaleAmount;
use Sunmi\Sunbay\Nexus\Model\Request\SaleRequest;

/**
 * SunbayClient business test
 * Note: This test requires a real API connection
 *
 * @author Andy Li
 * @since 2025-12-19
 */
class NexusClientTest extends TestCase
{
    private NexusClient $client;
    private Logger $logger;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create Monolog logger for testing (outputs to console)
        $this->logger = new Logger('test');
        $this->logger->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
        
        // Initialize client with test credentials (hardcoded for simplicity)
        $this->client = NexusClient::builder()
            ->apiKey('mfgyn0hvs9teofvuad03jkwvmtrdm2sb')
            ->baseUrl('https://open.sunbay.dev')
            ->connectTimeout(30000)
            ->readTimeout(60000)
            ->logger($this->logger)
            ->build();
    }

    protected function tearDown(): void
    {
        if (isset($this->client)) {
            $this->client->close();
        }
        parent::tearDown();
    }

    /**
     * Test sale transaction
     * Note: This test requires real API connection
     */
    public function testSale(): void
    {
        // Uncomment the line below to skip this test if API is not available
        // $this->markTestSkipped('Requires real API connection');

        // Set timeExpire (format: yyyy-MM-DDTHH:mm:ss+TIMEZONE, ISO 8601)
        $expireTime = new \DateTime('+10 minutes');
        $timeExpire = $expireTime->format('Y-m-d\TH:i:sP');

        // Build amount with all fields
        $amount = SaleAmount::builder()
            ->orderAmount(222.00)
            ->pricingCurrency('USD')
            ->build();

        // Build sale request
        $request = SaleRequest::builder()
            ->appId('test_sm6par3xf4d3tkum')
            ->merchantId('M1254947005')
            ->referenceOrderId('ORDER' . time())
            ->transactionRequestId('PAY_REQ_' . time())
            ->amount($amount)
            ->description('Starbucks - Americano x2')
            ->terminalSn('P344E51BJ0022')
            ->attach('{"storeId":"STORE001","tableNo":"T05"}')
            ->notifyUrl('https://merchant.com/notify')
            ->timeExpire($timeExpire)
            ->build();

        try {
            $response = $this->client->sale($request);
            
            $this->assertNotNull($response);
            $this->assertNotNull($response->getTransactionId());
            
            // Log transaction ID
            $this->logger->info('Transaction ID: ' . $response->getTransactionId());
        } catch (SunbayNetworkException $e) {
            $this->fail('Network Error: ' . $e->getMessage());
        } catch (SunbayBusinessException $e) {
            $this->fail('API Error: code=' . $e->getErrorCode() . ', msg=' . $e->getMessage());
        }
    }
}
