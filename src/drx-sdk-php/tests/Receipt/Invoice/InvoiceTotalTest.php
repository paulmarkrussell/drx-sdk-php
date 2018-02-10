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
    /**
     * @var \Dreceiptx\Receipt\Invoice\Invoice invoice
     */
    private $invoice;
    public function testEmptyReceiptHasZeroTotal() {
        $this->invoice = new \Dreceiptx\Receipt\Invoice\Invoice();
        $this->assertEquals(0, $this->invoice->getInvoiceTotals()->getTotalInvoiceAmount());
    }
}