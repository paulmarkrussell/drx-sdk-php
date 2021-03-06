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

class ClientTestHelper extends TestCase
{

    public static function createTestConfig() {
        $configManager = new MapBasedConfigManager();
        $configManager->setConfigValue(ConfigKeys::ExchangeHost, "https://aus-alpha.dreceiptx.net");
        $configManager->setConfigValue(ConfigKeys::DirectoryHost, "https://aus-directory-alpha.dreceiptx.net");
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