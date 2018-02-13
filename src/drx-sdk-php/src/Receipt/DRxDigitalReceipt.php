<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:16
 */

namespace Dreceiptx\Receipt;

use Dreceiptx\Receipt\Document\StandardBusinessDocumentHeader;
use Dreceiptx\Receipt\Invoice\Invoice;
use Dreceiptx\Receipt\Settlement\PaymentReceipt;

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
    private $seller;

    /**
     * @param \Dreceiptx\Receipt\Document\StandardBusinessDocumentHeader $standardBusinessDocumentHeader
     */
    public function setStandardBusinessDocumentHeader($standardBusinessDocumentHeader)
    {
        $this->standardBusinessDocumentHeader = $standardBusinessDocumentHeader;
    }

    /**
     * @return StandardBusinessDocumentHeader
     */
    public function getStandardBusinessDocumentHeader()
    {
        return $this->standardBusinessDocumentHeader;
    }

    /**
     * @param \Dreceiptx\Receipt\Invoice\Invoice $invoice
     */
    public function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * @return Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }

    /**
     * @param \Dreceiptx\Receipt\Settlement\PaymentReceipt[] $paymentReceipts
     */
    public function setPaymentReceipts(array $paymentReceipts)
    {
        $this->paymentReceipts = $paymentReceipts;
    }

    /**
     * @return PaymentReceipt[]
     */
    public function getPaymentReceipts()
    {
        if($this->paymentReceipts == null) {
            $this->paymentReceipts = array();
        }
        return $this->paymentReceipts;
    }

    /**
     * @param PaymentReceipt $receipt
     */
    public function addPaymentReceipt($receipt)    {
        if($this->paymentReceipts == null) {
            $this->paymentReceipts = array();
        }
        $index = count($this->paymentReceipts);
        $receipt->setSettlementIdentification($index);
        array_push($this->paymentReceipts, $receipt);

    }

    /**
     * @param mixed $seller
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
    }

    /**
     * @return mixed
     */
    public function getSeller()
    {
        return $this->seller;
    }


    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret -> standardBusinessDocumentHeader = $this->standardBusinessDocumentHeader;
        $ret->invoice = $this->invoice;
        $ret->paymentReceipts = $this->paymentReceipts;
        $ret->seller = $this->seller;
        return \Utils::removeNullProperties($ret);
    }
}