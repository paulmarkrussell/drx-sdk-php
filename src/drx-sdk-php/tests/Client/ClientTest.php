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
use Dreceiptx\Receipt\Tax\TaxCategory;
use Dreceiptx\Receipt\Tax\TaxCode;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testSimplePost()
    {
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

        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager,$httpClient);
        $receiptBuilder = new DigitalReceiptBuilder($configManager);
        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertEquals("Hello Post", $response->getContent());
    }
}