<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

require_once __DIR__ . "/../../../src/Receipt/Invoice/Invoice.php";

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
        $invoice->addLineItem($this->createStandardLineItem(1, 0));
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testZeroCountLineItem() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem($this->createStandardLineItem(0, 1000000));
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testSingleLineItem() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem($this->createStandardLineItem(1, 123.4));
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testTwoLineItems() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem($this->createStandardLineItem(1, 123.4));
        $invoice->addLineItem($this->createStandardLineItem(1, 432.1));
        $this->assertEquals(555.5, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testSingleLineItemLargeQuantity() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem($this->createStandardLineItem(100, 123.4));
        $this->assertEquals(12340, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
    }

    public function testLineItemWithNoTaxTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem($this->createStandardLineItem(1, 123.4));
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testLineItemWithZeroTaxTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = $this->createStandardLineItem(1, 123.4);
        $lineItem->addTax("Category code", 0, "Type code");
        $invoice->addLineItem($lineItem);
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    public function testLineItemWithValidTaxTax() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = $this->createStandardLineItem(1, 123.4);
        $lineItem->addTax("Category code", 12.3, "Type code");
        $invoice->addLineItem($lineItem);
        $this->assertEquals(123.4, $invoice->getInvoiceTotals()->getSubTotal()->getValue());
        $this->assertEquals(138.5782, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
        $this->assertEquals(15.1782, $invoice->getInvoiceTotals()->getTotalTaxAmount()->getValue());
    }

    private function createStandardLineItem($quantity, $price) {
        return \Dreceiptx\Receipt\LineItem\LineItem::create("Brand", "Name", "Line item description", $quantity, $price);
    }
}