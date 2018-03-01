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
require_once __DIR__."/../../src/Receipt/LineItem/LineItem.php";
require_once __DIR__."/../../src/Receipt/Tax/TaxCategory.php";
require_once __DIR__."/../../src/Receipt/Tax/TaxCode.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/ReceiptAllowanceCharge.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/SettlementType.php";

use Dreceiptx\Client\HTTPClientImpl;
use Dreceiptx\Client\Client;
use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\MapBasedConfigManager;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceChargeType;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType;
use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\AllowanceCharge\SettlementType;
use Dreceiptx\Receipt\Common\Country;
use Dreceiptx\Receipt\Common\Currency;
use Dreceiptx\Receipt\Common\Language;
use Dreceiptx\Receipt\DigitalReceiptBuilder;
use Dreceiptx\Receipt\DigitalReceiptContainer;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\Tax\Tax;
use Dreceiptx\Receipt\Tax\TaxCategory;
use Dreceiptx\Receipt\Tax\TaxCode;
use Dreceiptx\Users\UserIdentifierType;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Diff\LineTest;

class ClientTest extends TestCase
{
    public function testValidEmptyReceipt()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);

        $this->addHeader($receiptBuilder);

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testValidReceiptWithLineItem()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $this->addHeader($receiptBuilder);

        $receiptBuilder->addLineItem(LineItem::create("Test brand","Test name","Test description",1,100));

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testValidReceiptWithLineItemWithTax()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $this->addHeader($receiptBuilder);
        $lineItem = LineItem::create("Test brand","Test name","Test description",1,100);
        $lineItem->addTax(TaxCategory::APPLICABLE,27, TaxCode::GoodsAndServicesTax);
        $receiptBuilder->addLineItem($lineItem);

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testValidReceiptWithMultipleLineItems()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $this->addHeader($receiptBuilder);

        $receiptBuilder->addLineItem(LineItem::create("Test brand","Test name","Test description",1,100));
        $receiptBuilder->addLineItem(LineItem::create("Another test brand","Another test name","Another test description",5,760));

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testValidReceiptWithAllowance()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $this->addHeader($receiptBuilder);

        $receiptBuilder->addLineItem(LineItem::create("Test brand","Test name","Test description",1,100));
        $receiptBuilder->addAllowanceOrCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::ALLOWANCE,
            AllowanceChargeType::CREDIT_CUSTOMER_ACCOUNT,
            50,
            array(),
            SettlementType::ServiceFee,
            "A nice allowance"));

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testValidReceiptWithAllowanceAndTax()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $this->addHeader($receiptBuilder);

        $receiptBuilder->addLineItem(LineItem::create("Test brand","Test name","Test description",1,100));
        $receiptBuilder->addAllowanceOrCharge(ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::ALLOWANCE,
            AllowanceChargeType::CREDIT_CUSTOMER_ACCOUNT,
            50,
            [Tax::create(TaxCategory::APPLICABLE,27, TaxCode::GoodsAndServicesTax)],
            SettlementType::ServiceFee,
            "A nice allowance"));

        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testInvalidReceipt()
    {
        $configManager = $this->createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertEquals(400, $response->getHttpCode());
        $this->assertEquals(0, $response->getCode());
        $this->assertTrue(strlen($response->getExceptionMessage()) > 0);
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