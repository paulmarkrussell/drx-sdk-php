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
require_once __DIR__."/../../src/Users/UserIdentifierType.php";
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
use Dreceiptx\Users\UserIdentifierType;
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
        print("\n");
        print("RECEIPT");
        print("\n");
        print_r(json_encode($receipt));
        print("\n");
        $response = $client->sendProductionReceipt($receipt);
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals(null, $response->getExceptionMessage());
    }

    public function testValidReceiptWithBuilder()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);

        $this->addHeader($receiptBuilder);

        $receipt = $receiptBuilder->build();
        print("\n");
        print("RECEIPT");
        print("\n");
        print_r(json_encode($receipt));
        print("\n");
        $response = $client->sendProductionReceipt($receipt);
        print_r($response);
        print("\n");
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    private function addHeader($receiptBuilder) {
        $receiptBuilder->setReceiptDateTime(new \DateTime());
        $receiptBuilder->setDocumentStatusCode("ORIGINAL");
        $receiptBuilder->setReceiptNumber("1234567");
        $receiptBuilder->setInvoiceType("TAX_INVOICE");
        $receiptBuilder->setDocumentIdentification("DIGITALRECEIPT", "1234567", "true", new \DateTime());

        $receiptBuilder->setMerchantGLN("aus_concierge");
        $receiptBuilder->setUserGUID(UserIdentifierType::GUID, "UATAUSBETAUSR14757188985451189");
        $receiptBuilder->setDrxGLN("9377778071234");
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