<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Dreceiptx\Receipt;

require_once __DIR__ . "/../../src/Receipt/Invoice/Invoice.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/SettlementType.php";
require_once __DIR__ . "/../../src/Receipt/DigitalReceiptContainer.php";
require_once __DIR__ . "/../../src/Receipt/DigitalReceiptBuilder.php";
require_once __DIR__ . "/../../src/Receipt/DRxDigitalReceipt.php";
require_once __DIR__ . "/../../src/Config/MapBasedConfigManager.php";
require_once __DIR__ . "/../../src/Config/ConfigKeys.php";
require_once __DIR__ . "/../../src/Receipt/Common/Country.php";
require_once __DIR__ . "/../../src/Receipt/Common/Language.php";
require_once __DIR__ . "/../../src/Receipt/Common/Currency.php";
require_once __DIR__ . "/../../src/Receipt/Tax/TaxCategory.php";
require_once __DIR__ . "/../../src/Receipt/Tax/TaxCode.php";


require_once __DIR__."/TestUtils.php";

use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\MapBasedConfigManager;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType;
use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\Common\Country;
use Dreceiptx\Receipt\Common\Currency;
use Dreceiptx\Receipt\Common\Language;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\Tax\TaxCategory;
use Dreceiptx\Receipt\Tax\TaxCode;

class ReceiptBuilderTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyBuilder() {
        $testConfig = $this->createTestConfig();
        $receiptBuilder = new DigitalReceiptBuilder($testConfig);
        $container = $receiptBuilder->build();
        $recepit = $container->getDRxDigitalReceipt();
        $this->assertNotNull($recepit->getStandardBusinessDocumentHeader());

        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceLineItem()));
        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceAllowanceCharge()));
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getValue());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getCurrencyCode());
    }

    public function testSingleLineItem() {
        $testConfig = $this->createTestConfig();
        $receiptBuilder = new DigitalReceiptBuilder($testConfig);
        $lineItem = LineItem::create("Test brand","Test item","Test description",5,100);
        $receiptBuilder->addLineItem($lineItem);
        $recepit = $receiptBuilder->build()->getDRxDigitalReceipt();

        $this->assertEquals(1, count($recepit->getInvoice()->getInvoiceLineItem()));
        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceAllowanceCharge()));
        $this->assertEquals(500,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getValue());
        $this->assertEquals(500,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(500,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getValue());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getCurrencyCode());
    }

    public function testSingleAllowance() {
        $testConfig = $this->createTestConfig();
        $receiptBuilder = new DigitalReceiptBuilder($testConfig);
        $allowance = TestUtils::createAllowance(100, null);
        $receiptBuilder->addAllowanceOrCharge($allowance);
        $recepit = $receiptBuilder->build()->getDRxDigitalReceipt();

        $this->assertEquals(0, count($recepit->getInvoice()->getInvoiceLineItem()));
        $this->assertEquals(1, count($recepit->getInvoice()->getInvoiceAllowanceCharge()));
        $this->assertEquals(-100,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(0,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getValue());
        $this->assertEquals(-100,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(-100,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getValue());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getSubTotal()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalTaxAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalInvoiceAmount()->getCurrencyCode());
        $this->assertEquals(Currency::AustralianDollar,$recepit->getInvoice()->getInvoiceTotals()->getTotalLineAmountInclusiveAllowancesCharges()->getCurrencyCode());
    }
    /**
     * @return MapBasedConfigManager
     */
    private function createTestConfig() {
        $config = new MapBasedConfigManager();
        $config->setConfigValue(ConfigKeys::DefaultCountry, Country::Australia);
        $config->setConfigValue(ConfigKeys::DefaultLanguage, Language::English);
        $config->setConfigValue(ConfigKeys::DefaultCurrency, Currency::AustralianDollar);
        $config->setConfigValue(ConfigKeys::DefaultTaxCategory, TaxCategory::APPLICABLE);
        $config->setConfigValue(ConfigKeys::DefaultTaxCode, TaxCode::GoodsAndServicesTax);
        return $config;
    }
}