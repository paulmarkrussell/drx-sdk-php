<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Dreceiptx\Receipt\LineItem;
use Dreceiptx\Receipt\TestUtils;

require_once __DIR__ . "/../../../src/Receipt/Invoice/Invoice.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/SettlementType.php";
require_once __DIR__."/../TestUtils.php";

class LineItemCalcTest extends \PHPUnit\Framework\TestCase
{
    public function testNetTotalForZeroPrice() {
        $lineItem = new LineItem();
        $this->assertEquals(0, $lineItem->getNetTotal());
        $this->assertEquals(0, $lineItem->getTotal());
        $this->assertEquals(0, $lineItem->getTotalTax());

        $this->assertEquals(0, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(0, $lineItem->getAmountExclusiveAllowancesCharges());

    }

    public function testNetTotalForPrice() {
        $lineItem = new LineItem();
        $lineItem->setInvoicedQuantity(1);
        $lineItem->setItemPriceExclusiveAllowancesCharges(123.4);
        $this->assertEquals(123.4, $lineItem->getNetTotal());
        $this->assertEquals(123.4, $lineItem->getTotal());
        $this->assertEquals(0, $lineItem->getTotalTax());

        $this->assertEquals(123.4, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(123.4, $lineItem->getAmountExclusiveAllowancesCharges());
    }

    public function testNetTotalForMultipleItems() {
        $lineItem = new LineItem();
        $lineItem->setInvoicedQuantity(5);
        $lineItem->setItemPriceExclusiveAllowancesCharges(100);
        $this->assertEquals(500, $lineItem->getNetTotal());
        $this->assertEquals(500, $lineItem->getTotal());
        $this->assertEquals(0, $lineItem->getTotalTax());

        $this->assertEquals(500, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(500, $lineItem->getAmountExclusiveAllowancesCharges());
    }

    public function testTotalWithTax() {
        $lineItem = new LineItem();
        $lineItem->setInvoicedQuantity(5);
        $lineItem->setItemPriceExclusiveAllowancesCharges(100);
        $lineItem->addTax("",10, "");
        $this->assertEquals(500, $lineItem->getNetTotal());
        $this->assertEquals(550, $lineItem->getTotal());
        $this->assertEquals(50, $lineItem->getTotalTax());

        $this->assertEquals(500, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(500, $lineItem->getAmountExclusiveAllowancesCharges());
    }

    public function testTotalWithMultipleTaxes() {
        $lineItem = new LineItem();
        $lineItem->setInvoicedQuantity(5);
        $lineItem->setItemPriceExclusiveAllowancesCharges(100);
        $lineItem->addTax("",10, "");
        $lineItem->addTax("",15, "");
        $this->assertEquals(500, $lineItem->getNetTotal());
        $this->assertEquals(625, $lineItem->getTotal());
        $this->assertEquals(125, $lineItem->getTotalTax());

        $this->assertEquals(500, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(500, $lineItem->getAmountExclusiveAllowancesCharges());
    }

    public function testTotalWithTaxfreeAllowances() {
        $lineItem = new LineItem();
        $lineItem->setInvoicedQuantity(1);
        $lineItem->setItemPriceExclusiveAllowancesCharges(100);
        $lineItem->addInvoiceAllowanceCharge(TestUtils::createAllowance(13, array()));
        $lineItem->addInvoiceAllowanceCharge(TestUtils::createCharge(3, array()));
        $this->assertEquals(90, $lineItem->getNetTotal());
        $this->assertEquals(90, $lineItem->getTotal());
        $this->assertEquals(0, $lineItem->getTotalTax());

        $this->assertEquals(90, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(100, $lineItem->getAmountExclusiveAllowancesCharges());
    }

    public function testTotalWithTaxedAllowances() {
        $lineItem = new LineItem();
        $lineItem->setInvoicedQuantity(1);
        $lineItem->setItemPriceExclusiveAllowancesCharges(100);
        $lineItem->addTax("", 15, "");
        $lineItem->addInvoiceAllowanceCharge(TestUtils::createAllowanceWithTax(30, 10));
        $lineItem->addInvoiceAllowanceCharge(TestUtils::createChargeWithTax(25, 5));
        $this->assertEquals(95, $lineItem->getNetTotal());
        $this->assertEquals(108.25, $lineItem->getTotal());
        $this->assertEquals(13.25, $lineItem->getTotalTax());

        $this->assertEquals(95, $lineItem->getAmountInclusiveAllowancesCharges());
        $this->assertEquals(100, $lineItem->getAmountExclusiveAllowancesCharges());
    }
}