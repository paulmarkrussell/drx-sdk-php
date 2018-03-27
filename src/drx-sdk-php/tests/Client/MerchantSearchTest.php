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
require_once __DIR__."/ClientTestHelper.php";

use Dreceiptx\Client\HTTPClientImpl;
use Dreceiptx\Client\Client;
use Dreceiptx\Client\Response\MerchantResponse;
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

class MerchantSearchTest extends TestCase
{
    public function testGetMerchant()
    {
        $configManager = ClientTestHelper::createTestConfig();
        $httpClient = new HTTPClientImpl();
        $client = new Client($configManager, $httpClient);

        $response = $client->lookupMerchant("93489790000054");
        $this->assertEquals(200, $response->getHttpCode());
        $this->assertEquals("", $response->getExceptionMessage());

        $this->assertEquals("93489790000054", $response->getId());
        $this->assertEquals("Rydo Technologies Pty Ltd", $response->getFullName());
        $this->assertEquals("Rydo", $response->getCommonName());
        $this->assertEquals("611 475 113", $response->getBusinessTaxNumber());
        $this->assertEquals("GST", $response->getBusinessTaxNumberType());
        $this->assertEquals("69 611 475 113", $response->getBusinessRegistrationNumber());
        $this->assertEquals("131 001", $response->getPrimaryPhone());
        $this->assertEquals("info@rydo.com.au", $response->getPrimaryEmail());
        $this->assertEquals("https://www.rydo.com.au/", $response->getWebsite());
        $address = $response->getPrimaryAddress();
        $this->assertEquals("", $address->getBuildingnumber());
        $this->assertEquals("FAC House",$address->getStreetnumber());
        $this->assertEquals("7th Street", $address->getStreet());
        $this->assertEquals("Mascot", $address->getCity());
        $this->assertEquals("NSW", $address->getState());
        $this->assertEquals("2020", $address->getPostcode());
        $this->assertEquals("AUS", $address->getCountry());
        $this->assertEquals("Corporate Travel", $response->getSector());
        $this->assertEquals("Ground Transportation - Taxi", $response->getIndustry());
        $this->assertEquals("Active", $response->getStatus());
    }
}