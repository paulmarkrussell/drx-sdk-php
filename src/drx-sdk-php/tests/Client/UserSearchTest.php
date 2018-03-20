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
require_once __DIR__."/ClientTestHelper.php";

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

class UserSearchTest extends TestCase
{
    public function testSearchDirectoryUser()
    {
        $configManager = ClientTestHelper::createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);

        $response = $client->searchUserInDirectory(UserIdentifierType::EMAIL, "test@dreceiptx.net");
        print("\n");
        print_r($response);
        print("\n");
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testSearchUser() {
        $configManager = ClientTestHelper::createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);

        $response = $client->searchUser(UserIdentifierType::GUID, "93489790010000000000002439");
        print("\n");
        print_r($response);
        print("\n");
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }

    public function testGetAccountUser() {
        $configManager = ClientTestHelper::createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);

        $response = $client->getAccountUsers("UAT-TEST-MYDIGITALRECEIPTS");
        print("\n");
        print_r($response);
        print("\n");
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
    }
}