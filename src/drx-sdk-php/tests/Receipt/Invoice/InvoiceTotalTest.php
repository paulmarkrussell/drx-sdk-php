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
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
    }

    public function testZeroValuedLineItemYieldsGoodTotal() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $lineItem = new Dreceiptx\Receipt\LineItem\LineItem();
        $invoice->addLineItem($lineItem);
        $this->assertEquals(0, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
    }

    public function testSingleValuedLineItemYieldsGoodTotal() {
        $invoice = new Dreceiptx\Receipt\Invoice\Invoice();
        $invoice->addLineItem($this->createStandardLineItem(1, 123.1));
        $this->assertEquals(123.1, $invoice->getInvoiceTotals()->getTotalInvoiceAmount()->getValue());
    }

    private function createStandardLineItem($quantity, $price) {
        return \Dreceiptx\Receipt\LineItem\LineItem::create("Brand", "Name", "Line item description", $quantity, $price);
    }
}