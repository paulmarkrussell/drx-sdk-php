<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:16
 */

namespace Dreceiptx\Receipt;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__ . '/Document/StandardBusinessDocumentHeader.php';
require_once __DIR__ . '/Invoice/Invoice.php';
require_once __DIR__ . '/Settlement/PaymentReceipt.php';
require_once __DIR__."/../Utils/Utils.php";

class DRxDigitalReceipt implements \JsonSerializable
{
    private $standardBusinessDocumentHeader;
    private $invoice;
    private $paymentReceipts;

    /**
     * @param \Dreceiptx\Receipt\Document\StandardBusinessDocumentHeader $standardBusinessDocumentHeader
     */
    public function setStandardBusinessDocumentHeader($standardBusinessDocumentHeader)
    {
        $this->standardBusinessDocumentHeader = $standardBusinessDocumentHeader;
    }

    /**
     * @param \Dreceiptx\Receipt\Invoice\Invoice $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @param \Dreceiptx\Receipt\Settlement\PaymentReceipt[] $paymentReceipts
     */
    public function setPaymentReceipts(array $paymentReceipts)
    {
        $this->paymentReceipts = $paymentReceipts;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret -> standardBusinessDocumentHeader = $this->standardBusinessDocumentHeader;
        $ret->invoice = $this->invoice;
        $ret->paymentReceipts = $this->paymentReceipts;
        return \Utils::removeNullProperties($ret);
    }
}