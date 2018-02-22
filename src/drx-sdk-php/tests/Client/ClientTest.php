<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Test\Client;

require_once __DIR__."/../../src/Client/HTTP/HTTPClientImpl.php";
require_once __DIR__."/../../src/Client/Client.php";
require_once __DIR__."/../../src/Config/ConfigKeys.php";
require_once __DIR__."/../../src/Config/MapBasedConfigManager.php";
require_once __DIR__."/../../src/Receipt/Common/Country.php";
require_once __DIR__."/../../src/Receipt/Common/Currency.php";
require_once __DIR__."/../../src/Receipt/Common/Language.php";
require_once __DIR__."/../../src/Receipt/Common/Country.php";
require_once __DIR__."/../../src/Receipt/DigitalReceiptBuilder.php";
require_once __DIR__."/../../src/Receipt/DigitalReceiptContainer.php";
require_once __DIR__."/../../src/Receipt/Tax/TaxCategory.php";
require_once __DIR__."/../../src/Receipt/Tax/TaxCode.php";

use Dreceiptx\Client\HTTPClientImpl;
use Dreceiptx\Client\Client;
use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\MapBasedConfigManager;
use Dreceiptx\Receipt\Common\Country;
use Dreceiptx\Receipt\Common\Currency;
use Dreceiptx\Receipt\Common\Language;
use Dreceiptx\Receipt\DigitalReceiptBuilder;
use Dreceiptx\Receipt\DigitalReceiptContainer;
use Dreceiptx\Receipt\Tax\TaxCategory;
use Dreceiptx\Receipt\Tax\TaxCode;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testValidReceipt()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $text = file_get_contents(__DIR__."/../../../../samples/sample01.json");
        $receipt = DigitalReceiptContainer::fromJson(json_decode($text))->getDRxDigitalReceipt()->jsonSerialize();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals(null, $response->getExceptionMessage());
    }

    public function testInvalidReceipt()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertFalse($response->isSuccess());
        $this->assertEquals(400, $response->getHttpCode());
        $this->assertEquals(0, $response->getCode());
        $this->assertEquals("The structure of the data provided didn't comply with the defined schema for version [1.7.0] and method [POST]::\n- object has missing required properties ([\"creationDateTime\",\"documentStatusCode\",\"invoiceIdentification\",\"invoiceTotals\",\"invoiceType\"])\n- object has missing required properties ([\"receiver\",\"sender\"])", $response->getExceptionMessage());
    }

    private function createTestConfig() {
        $configManager = new MapBasedConfigManager();
        $configManager->setConfigValue(ConfigKeys::ExchangeHost, "https://aus-alpha.dreceiptx.net");
        $configManager->setConfigValue(ConfigKeys::DirectoryHost, "https://aus-alpha.dreceiptx.net");
        $configManager->setConfigValue(ConfigKeys::ReceiptVersion, "1.7.0");
        $configManager->setConfigValue(ConfigKeys::UserVersion, "1.7.0");
        $configManager->setConfigValue(ConfigKeys::DownloadDirectory, "./");
        $configManager->setConfigValue(ConfigKeys::APIRequesterId, "requesterId");
        $configManager->setConfigValue(ConfigKeys::APIKey, "API_KEY");
        $configManager->setConfigValue(ConfigKeys::APISecret, "API_SECRET");

        $configManager->setConfigValue(ConfigKeys::DefaultCountry, Country::Australia);
        $configManager->setConfigValue(ConfigKeys::DefaultLanguage, Language::English);
        $configManager->setConfigValue(ConfigKeys::DefaultCurrency, Currency::AustralianDollar);
        $configManager->setConfigValue(ConfigKeys::DefaultTaxCategory, TaxCategory::APPLICABLE);
        $configManager->setConfigValue(ConfigKeys::DefaultTaxCode, TaxCode::GoodsAndServicesTax);
        return $configManager;
    }
}