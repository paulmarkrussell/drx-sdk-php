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
use Dreceiptx\Users\NewUser;
use Dreceiptx\Users\UserIdentifierType;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\Diff\LineTest;

class UserAddTest extends TestCase
{
    public function testAddUser()
    {
        $configManager = ClientTestHelper::createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);

        $user = new NewUser("lajthabalazs@yahoo.com", "lajtha-balazs-01");
        $user->addConfig("EndPointId","testingEndpoint");
        $user->addMetaData("Team", "team#1");
        $response = $client->registerNewUser($user);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(201, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());
        $this->assertEquals(1, $response->getResponseData()->getUsersRegistered());
        $this->assertEquals("lajthabalazs@yahoo.com", $response->getResponseData()->getUsers()[0]->getEmail());
    }
}