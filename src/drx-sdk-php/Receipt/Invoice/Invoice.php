<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:26
 */

namespace Dreceiptx\Receipt\Invoice;

use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\Common\DespatchInformation;
use Dreceiptx\Receipt\Common\LocationInformation;
use Dreceiptx\Receipt\Common\TransactionalParty;
use Dreceiptx\Receipt\LineItem\LineItem;

require_once __DIR__."/../LineItem/LineItem.php";
require_once __DIR__."/../AllowanceCharge/ReceiptAllowanceCharge.php";
require_once __DIR__."/../Common/DespatchInformation.php";
require_once __DIR__."/../Common/LocationInformation.php";
require_once __DIR__."/../Common/TransactionalParty.php";

require_once __DIR__."/Identification.php";
require_once __DIR__."/InvoiceSummary.php";
require_once __DIR__."/../../Utils/Utils.php";

class Invoice implements \JsonSerializable
{
    private $creationDateTime;
    private $documentStatusCode;
    private $invoiceIdentification;
    private $salesOrder;
    private $purchaseOrder;
    private $customerReference;
    private $billTo;
    private $invoiceType;
    private $countryOfSupplyOfGoods;
    private $invoiceCurrencyCode;
    private $invoiceTotals;
    private $invoiceLineItem;
    private $invoiceAllowanceCharge;
    private $shipFrom;
    private $shipTo;
    private $despatchInformation;

    /**
     * @param string $documentStatusCode
     */
    public function setDocumentStatusCode($documentStatusCode)
    {
        $this->documentStatusCode = $documentStatusCode;
    }

    /**
     * @return string
     */
    public function getDocumentStatusCode()
    {
        return $this->documentStatusCode;
    }

    /**
     * @param string $invoiceType
     */
    public function setInvoiceType($invoiceType)
    {
        $this->invoiceType = $invoiceType;
    }

    /**
     * @return string
     */
    public function getInvoiceType()
    {
        return $this->invoiceType;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\TransactionalParty $billTo
     */
    public function setBillTo($billTo)
    {
        $this->billTo = $billTo;
    }

    /**
     * @return TransactionalParty
     */
    public function getBillTo()
    {
        if($this->billTo == null) {
            $this->billTo = new TransactionalParty();
        }
        return $this->billTo;
    }

    /**
     * @param Identification $purchaseOrder
     */
    public function setPurchaseOrder($purchaseOrder)
    {
        $this->purchaseOrder = $purchaseOrder;
    }

    /**
     * @return Identification
     */
    public function getPurchaseOrder()
    {
        if($this->purchaseOrder == null){
            $this->purchaseOrder = new Identification();
        }
        return $this->purchaseOrder;
    }

    /**
     * @param Identification $customerReference
     */
    public function setCustomerReference($customerReference)
    {
        $this->customerReference = $customerReference;
    }

    /**
     * @return Identification
     */
    public function getCustomerReference()
    {
        if($this->customerReference == null){
            $this->customerReference = new Identification();
        }
        return $this->customerReference;
    }

    /**
     * @param Identification $invoiceIdentification
     */
    public function setInvoiceIdentification($invoiceIdentification)
    {
        $this->invoiceIdentification = $invoiceIdentification;
    }

    /**
     * @return Identification
     */
    public function getInvoiceIdentification()
    {
        if($this->invoiceIdentification == null){
            $this->invoiceIdentification = new Identification();
        }
        return $this->invoiceIdentification;
    }

    /**
     * @param \DateTime $creationDateTime
     */
    public function setCreationDateTime($creationDateTime)
    {
        $this->creationDateTime = $creationDateTime;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDateTime()
    {
        return $this->creationDateTime;
    }

    /**
     * @param string $invoiceCurrencyCode
     */
    public function setInvoiceCurrencyCode($invoiceCurrencyCode)
    {
        $this->invoiceCurrencyCode = $invoiceCurrencyCode;
    }

    /**
     * @return string
     */
    public function getInvoiceCurrencyCode()
    {
        return $this->invoiceCurrencyCode;
    }

    /**
     * @param string $countryOfSupplyOfGoods
     */
    public function setCountryOfSupplyOfGoods($countryOfSupplyOfGoods)
    {
        $this->countryOfSupplyOfGoods = $countryOfSupplyOfGoods;
    }

    /**
     * @return string
     */
    public function getCountryOfSupplyOfGoods()
    {
        return $this->countryOfSupplyOfGoods;
    }

    /**
     * @param \Dreceiptx\Receipt\LineItem\LineItem[] $invoiceLineItem
     */
    public function setInvoiceLineItem(array $invoiceLineItem)
    {
        $this->invoiceLineItem = $invoiceLineItem;
    }

    /**
     * @return LineItem[]
     */
    public function getInvoiceLineItem()
    {
        if($this->invoiceLineItem == null) {
            $this->invoiceLineItem = array();
        }
        return $this->invoiceLineItem;
    }

    /**
     * @param \Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge[] $invoiceAllowanceCharge
     */
    public function setInvoiceAllowanceCharge(array $invoiceAllowanceCharge)
    {
        $this->invoiceAllowanceCharge = $invoiceAllowanceCharge;
    }

    /**
     * @return ReceiptAllowanceCharge[]
     */
    public function getInvoiceAllowanceCharge()
    {
        if($this->invoiceAllowanceCharge == null) {
            $this->invoiceAllowanceCharge = array();
        }
        return $this->invoiceAllowanceCharge;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\LocationInformation $shipFrom
     */
    public function setShipFrom($shipFrom)
    {
        $this->shipFrom = $shipFrom;
    }

    /**
     * @return LocationInformation
     */
    public function getShipFrom()
    {
        if($this->shipFrom == null) {
            $this->shipFrom = new LocationInformation();
        }
        return $this->shipFrom;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\LocationInformation $shipTo
     */
    public function setShipTo($shipTo)
    {
        $this->shipTo = $shipTo;
    }

    /**
     * @return LocationInformation
     */
    public function getShipTo()
    {
        if($this->shipTo == null) {
            $this->shipTo = new LocationInformation();
        }
        return $this->shipTo;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\DespatchInformation $despatchInformation
     */
    public function setDespatchInformation($despatchInformation)
    {
        $this->despatchInformation = $despatchInformation;
    }

    /**
     * @return DespatchInformation
     */
    public function getDespatchInformation()
    {
        if($this->despatchInformation == null) {
            $this->despatchInformation = new DespatchInformation();
        }
        return $this->despatchInformation;
    }

    /**
     * @param InvoiceSummary $invoiceTotals
     */
    public function setInvoiceTotals($invoiceTotals)
    {
        $this->invoiceTotals = $invoiceTotals;
    }

    /**
     * @return InvoiceSummary
     */
    public function getInvoiceTotals()
    {
        if($this->invoiceTotals == null) {
            $this->invoiceTotals = new InvoiceSummary();
        }
        return $this->invoiceTotals;
    }

    /**
     * @param Identification $salesOrder
     */
    public function setSalesOrder($salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    /**
     * @return Identification
     */
    public function getSalesOrder()
    {
        if($this->salesOrder == null) {
            $this->salesOrder = new Identification();
        }
        return $this->salesOrder;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->documentStatusCode = $this->documentStatusCode;
        $ret->invoiceType = $this->invoiceType;
        $ret->billTo = $this->billTo;
        $ret->purchaseOrder = $this->purchaseOrder;
        $ret->customerReference = $this->customerReference;
        $ret->invoiceIdentification  = $this->invoiceIdentification;
        $ret->creationDateTime  = $this->creationDateTime->format("Y-m-d\TH:i:sP");
        $ret->invoiceCurrencyCode  = $this->invoiceCurrencyCode;
        $ret->countryOfSupplyOfGoods  = $this->countryOfSupplyOfGoods;
        $ret->invoiceLineItem = $this->invoiceLineItem;
        $ret->invoiceAllowanceCharge = $this->invoiceAllowanceCharge;
        $ret->shipFrom = $this->shipFrom;
        $ret->shipTo = $this->shipTo;
        $ret->despatchInformation = $this->despatchInformation;
        $ret->invoiceTotals = $this->invoiceTotals;
        $ret->salesOrder = $this->salesOrder;
        return \Utils::removeNullProperties($ret);
    }
}