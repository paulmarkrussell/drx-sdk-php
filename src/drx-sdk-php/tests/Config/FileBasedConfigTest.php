<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace TestConfig;

require_once __DIR__."/../../src/Config/ConfigManager.php";
require_once __DIR__."/../../src/Config/FileBasedConfigManager.php";
require_once __DIR__."/../../src/Config/ConfigKeys.php";

use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\FileBasedConfigManager;

class FileBasedConfigTest extends \PHPUnit\Framework\TestCase
{

    public function testWrongArrayOrder()
    {
        $fileName = microtime().".config";
        $configManagerWrite = new FileBasedConfigManager($fileName);
        $configManagerWrite->setConfigValue(ConfigKeys::DefaultCountry, "test_value DefaultCountry");
        $configManagerWrite->setConfigValue(ConfigKeys::DefaultCurrency, "test_value DefaultCurrency");
        $configManagerWrite->setConfigValue(ConfigKeys::ReceiptVersion, "test_value ReceiptVersion");
        $configManagerWrite->setConfigValue(ConfigKeys::MerchantGLN, "test_value MerchantGLN");
        $configManagerWrite->setConfigValue(ConfigKeys::dRxGLN, "test_value dRxGLN");
        $configManagerWrite->setConfigValue(ConfigKeys::DefaultTaxCode, "test_value DefaultTaxCode");
        $configManagerWrite->setConfigValue(ConfigKeys::DefaultTaxCategory, "test_value DefaultTaxCategory");
        $configManagerWrite->setConfigValue(ConfigKeys::DefaultLanguage, "test_value DefaultLanguage");
        $configManagerWrite->setConfigValue(ConfigKeys::APIKey, "test_value APIKey");
        $configManagerWrite->setConfigValue(ConfigKeys::APIRequesterId, "test_value APIRequesterId");
        $configManagerWrite->setConfigValue(ConfigKeys::APISecret, "test_value APISecret");
        $configManagerWrite->setConfigValue(ConfigKeys::DirectoryHost, "test_value DirectoryHost");
        $configManagerWrite->setConfigValue(ConfigKeys::DirectoryProtocol, "test_value DirectoryProtocol");
        $configManagerWrite->setConfigValue(ConfigKeys::DownloadDirectory, "test_value DownloadDirectory");
        $configManagerWrite->setConfigValue(ConfigKeys::ExchangeHost, "test_value ExchangeHost");
        $configManagerWrite->setConfigValue(ConfigKeys::ExchangeProtocol, "test_value ExchangeProtocol");
        $configManagerWrite->setConfigValue(ConfigKeys::UserVersion, "test_value UserVersion");

        $this->assertEquals("test_value DefaultCountry", $configManagerWrite->getConfigValue(ConfigKeys::DefaultCountry));
        $this->assertEquals("test_value DefaultCurrency", $configManagerWrite->getConfigValue(ConfigKeys::DefaultCurrency));
        $this->assertEquals("test_value ReceiptVersion", $configManagerWrite->getConfigValue(ConfigKeys::ReceiptVersion));
        $this->assertEquals("test_value MerchantGLN", $configManagerWrite->getConfigValue(ConfigKeys::MerchantGLN));
        $this->assertEquals("test_value dRxGLN", $configManagerWrite->getConfigValue(ConfigKeys::dRxGLN));
        $this->assertEquals("test_value DefaultTaxCode", $configManagerWrite->getConfigValue(ConfigKeys::DefaultTaxCode));
        $this->assertEquals("test_value DefaultTaxCategory", $configManagerWrite->getConfigValue(ConfigKeys::DefaultTaxCategory));
        $this->assertEquals("test_value DefaultLanguage", $configManagerWrite->getConfigValue(ConfigKeys::DefaultLanguage));
        $this->assertEquals("test_value APIKey", $configManagerWrite->getConfigValue(ConfigKeys::APIKey));
        $this->assertEquals("test_value APIRequesterId", $configManagerWrite->getConfigValue(ConfigKeys::APIRequesterId));
        $this->assertEquals("test_value APISecret", $configManagerWrite->getConfigValue(ConfigKeys::APISecret));
        $this->assertEquals("test_value DirectoryHost", $configManagerWrite->getConfigValue(ConfigKeys::DirectoryHost));
        $this->assertEquals("test_value DirectoryProtocol", $configManagerWrite->getConfigValue(ConfigKeys::DirectoryProtocol));
        $this->assertEquals("test_value DownloadDirectory", $configManagerWrite->getConfigValue(ConfigKeys::DownloadDirectory));
        $this->assertEquals("test_value ExchangeHost", $configManagerWrite->getConfigValue(ConfigKeys::ExchangeHost));
        $this->assertEquals("test_value ExchangeProtocol", $configManagerWrite->getConfigValue(ConfigKeys::ExchangeProtocol));
        $this->assertEquals("test_value UserVersion", $configManagerWrite->getConfigValue(ConfigKeys::UserVersion));

        $configManagerRead = new FileBasedConfigManager($fileName);
        $this->assertEquals("test_value DefaultCountry", $configManagerRead->getConfigValue(ConfigKeys::DefaultCountry));
        $this->assertEquals("test_value DefaultCurrency", $configManagerRead->getConfigValue(ConfigKeys::DefaultCurrency));
        $this->assertEquals("test_value ReceiptVersion", $configManagerRead->getConfigValue(ConfigKeys::ReceiptVersion));
        $this->assertEquals("test_value MerchantGLN", $configManagerRead->getConfigValue(ConfigKeys::MerchantGLN));
        $this->assertEquals("test_value dRxGLN", $configManagerRead->getConfigValue(ConfigKeys::dRxGLN));
        $this->assertEquals("test_value DefaultTaxCode", $configManagerRead->getConfigValue(ConfigKeys::DefaultTaxCode));
        $this->assertEquals("test_value DefaultTaxCategory", $configManagerRead->getConfigValue(ConfigKeys::DefaultTaxCategory));
        $this->assertEquals("test_value DefaultLanguage", $configManagerRead->getConfigValue(ConfigKeys::DefaultLanguage));
        $this->assertEquals("test_value APIKey", $configManagerRead->getConfigValue(ConfigKeys::APIKey));
        $this->assertEquals("test_value APIRequesterId", $configManagerRead->getConfigValue(ConfigKeys::APIRequesterId));
        $this->assertEquals("test_value APISecret", $configManagerRead->getConfigValue(ConfigKeys::APISecret));
        $this->assertEquals("test_value DirectoryHost", $configManagerRead->getConfigValue(ConfigKeys::DirectoryHost));
        $this->assertEquals("test_value DirectoryProtocol", $configManagerRead->getConfigValue(ConfigKeys::DirectoryProtocol));
        $this->assertEquals("test_value DownloadDirectory", $configManagerRead->getConfigValue(ConfigKeys::DownloadDirectory));
        $this->assertEquals("test_value ExchangeHost", $configManagerRead->getConfigValue(ConfigKeys::ExchangeHost));
        $this->assertEquals("test_value ExchangeProtocol", $configManagerRead->getConfigValue(ConfigKeys::ExchangeProtocol));
        $this->assertEquals("test_value UserVersion", $configManagerRead->getConfigValue(ConfigKeys::UserVersion));
        unlink($fileName);
    }
}