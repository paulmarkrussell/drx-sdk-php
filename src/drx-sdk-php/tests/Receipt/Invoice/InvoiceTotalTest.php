<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

require_once __DIR__ . "/../../../src/Receipt/Invoice/Invoice.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/SettlementType.php";
require_once __DIR__."/../TestUtils.php";

class InvoiceTotalTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyReceiptHasZeroTotal() {
        $invoice = new \Dreceiptx\Receipt\Invoice\Invoice();
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testMissingLineItem() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = new Dreceiptx\Receipt\LineItem\LineItem();
        $invoice->addLineItem($lineItem);
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testZeroValueLineItem() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItem(1, 0));
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testZeroCountLineItem() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItem(0, 1000000));
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testSingleLineItem() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItem(1, 123.4));
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testTwoLineItems() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItem(1, 123.4));
        $invoice->addLineItem(TestUtils::createLineItem(1, 432.1));
        $this->assertEquals(555.5, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testSingleLineItemLargeQuantity() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItem(100, 123.4));
        $this->assertEquals(12340, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testLineItemWithMissingTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItem(1, 1500));
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testLineItemWithZeroTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = TestUtils::createLineItem(1, 1500);
        $lineItem->addTax("Category code", 0, "Type code");
        $invoice->addLineItem($lineItem);
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testLineItemWithValidTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = TestUtils::createLineItem(1, 1500);
        $lineItem->addTax("Category code", 10.1, "Type code");
        $invoice->addLineItem($lineItem);
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(1651.5, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(151.5, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testLineItemWithMultipleTaxes() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = TestUtils::createLineItem(1, 1500);
        $lineItem->addTax("Category code", 10.1, "Type code");
        $lineItem->addTax("Category code", 9.9, "Type code");
        $invoice->addLineItem($lineItem);
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(1800, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(300, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testMultipleLineItemsWithTaxes() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem1 = TestUtils::createLineItem(1, 500);
        $lineItem1->addTax("Category code", 10.1, "Type code");
        $lineItem1->addTax("Category code", 9.9, "Type code");
        $invoice->addLineItem($lineItem1);
        $lineItem2 = TestUtils::createLineItem(1, 1000);
        $lineItem2->addTax("Category code", 5.5, "Type code");
        $lineItem2->addTax("Category code", 4.5, "Type code");
        $invoice->addLineItem($lineItem2);
        $this->assertEquals(1500, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(1700, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(200, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testSingleChargeWithNoTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $taxes = array();
        $invoice->addAllowanceCharge(TestUtils::createCharge(123.4, $taxes));
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testSingleChargeWithTaxes() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $taxes = array();
        array_push($taxes, \Dreceiptx\Receipt\Tax\Tax::create("Category code", 4.6, "Type code"));
        array_push($taxes, \Dreceiptx\Receipt\Tax\Tax::create("Category code", 15.4, "Type code"));

        $invoice->addAllowanceCharge(TestUtils::createCharge(1000, $taxes));
        $this->assertEquals(1000, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(1200, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(200, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testSingleAllowanceWithNoTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $taxes = array();
        $invoice->addAllowanceCharge(TestUtils::createAllowance(123.4, $taxes));
        $this->assertEquals(-123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testSingleAllowanceWithTaxes() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $taxes = array();
        array_push($taxes, \Dreceiptx\Receipt\Tax\Tax::create("Category code", 4.6, "Type code"));
        array_push($taxes, \Dreceiptx\Receipt\Tax\Tax::create("Category code", 15.4, "Type code"));
        $invoice->addAllowanceCharge(TestUtils::createAllowance(1000, $taxes));
        $this->assertEquals(-1000, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(-1200, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(-200, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testReceiptTotal() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem(TestUtils::createLineItemWithTax(3, 100, 10));
        $invoice->addLineItem(TestUtils::createLineItemWithTax(10, 300, 20));
        $invoice->addLineItem(TestUtils::createLineItemWithTax(5, 400, 30));
        $invoice->addAllowanceCharge(TestUtils::createAllowanceWithTax(50, 10));
        $invoice->addAllowanceCharge(TestUtils::createAllowanceWithTax(10, 20));
        $invoice->addAllowanceCharge(TestUtils::createChargeWithTax(20, 20));
        $invoice->addAllowanceCharge(TestUtils::createChargeWithTax(15, 10));

        $this->assertEquals(5275, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(6503.5, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(1228.5, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }
}