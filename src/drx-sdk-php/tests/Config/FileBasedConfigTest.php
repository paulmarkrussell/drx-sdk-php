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
        $configManager = new FileBasedConfigManager($fileName);
        $configManager->setConfigValue(ConfigKeys::DefaultCountry, "test_value DefaultCountry");
        $configManager->setConfigValue(ConfigKeys::DefaultCurrency, "test_value DefaultCurrency");
        $configManager->setConfigValue(ConfigKeys::ReceiptVersion, "test_value ReceiptVersion");
        $configManager->setConfigValue(ConfigKeys::MerchantGLN, "test_value MerchantGLN");
        $configManager->setConfigValue(ConfigKeys::dRxGLN, "test_value dRxGLN");
        $configManager->setConfigValue(ConfigKeys::DefaultTaxCode, "test_value DefaultTaxCode");
        $configManager->setConfigValue(ConfigKeys::DefaultTaxCategory, "test_value DefaultTaxCategory");
        $configManager->setConfigValue(ConfigKeys::DefaultLanguage, "test_value DefaultLanguage");
        $configManager->setConfigValue(ConfigKeys::APIKey, "test_value APIKey");
        $configManager->setConfigValue(ConfigKeys::APIRequesterId, "test_value APIRequesterId");
        $configManager->setConfigValue(ConfigKeys::APISecret, "test_value APISecret");
        $configManager->setConfigValue(ConfigKeys::DirectoryHost, "test_value DirectoryHost");
        $configManager->setConfigValue(ConfigKeys::DirectoryProtocol, "test_value DirectoryProtocol");
        $configManager->setConfigValue(ConfigKeys::DownloadDirectory, "test_value DownloadDirectory");
        $configManager->setConfigValue(ConfigKeys::ExchangeHost, "test_value ExchangeHost");
        $configManager->setConfigValue(ConfigKeys::ExchangeProtocol, "test_value ExchangeProtocol");
        $configManager->setConfigValue(ConfigKeys::UserVersion, "test_value UserVersion");

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
    }
}