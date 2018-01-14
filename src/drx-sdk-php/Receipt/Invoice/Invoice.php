<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:26
 */

namespace Dreceiptx\Receipt\Invoice;

require_once __DIR__."/../LineItem/LineItem.php";
require_once __DIR__."/../AllowanceCharge/ReceiptAllowanceCharge.php";
require_once __DIR__."/../Common/DespatchInformation.php";
require_once __DIR__."/../Common/LocationInformation.php";
require_once __DIR__."/../Common/TransactionalParty.php";

require_once __DIR__."/Identification.php";

class Invoice implements \JsonSerializable
{
    private $documentStatusCode;
    private $invoiceType;
    private $seller;
    private $billTo;
    private $purchaseOrder;
    private $customerReference;
    private $invoiceIdentification ;
    private $creationDateTime ;
    private $invoiceCurrencyCode ;
    private $countryOfSupplyOfGoods ;
    private $invoiceLineItem;
    private $invoiceAllowanceCharge;
    private $shipFrom;
    private $shipTo;
    private $despatchInformation ;
    private $invoiceTotals;
    private $salesOrder;

    /**
     * @param string $documentStatusCode
     */
    public function setDocumentStatusCode($documentStatusCode)
    {
        $this->documentStatusCode = $documentStatusCode;
    }

    /**
     * @param string $invoiceType
     */
    public function setInvoiceType($invoiceType)
    {
        $this->invoiceType = $invoiceType;
    }

    /**
     * @param TransactionalParty $seller
     */
    public function setSeller($seller)
    {
        $this->seller = $seller;
    }

    /**
     * @param TransactionalParty $billTo
     */
    public function setBillTo($billTo)
    {
        $this->billTo = $billTo;
    }

    /**
     * @param Identification $purchaseOrder
     */
    public function setPurchaseOrder($purchaseOrder)
    {
        $this->purchaseOrder = $purchaseOrder;
    }

    /**
     * @param Identification $customerReference
     */
    public function setCustomerReference($customerReference)
    {
        $this->customerReference = $customerReference;
    }

    /**
     * @param Identification $invoiceIdentification
     */
    public function setInvoiceIdentification($invoiceIdentification)
    {
        $this->invoiceIdentification = $invoiceIdentification;
    }

    /**
     * @param \DateTime $creationDateTime
     */
    public function setCreationDateTime($creationDateTime)
    {
        $this->creationDateTime = $creationDateTime;
    }

    /**
     * @param string $invoiceCurrencyCode
     */
    public function setInvoiceCurrencyCode($invoiceCurrencyCode)
    {
        $this->invoiceCurrencyCode = $invoiceCurrencyCode;
    }

    /**
     * @param string $countryOfSupplyOfGoods
     */
    public function setCountryOfSupplyOfGoods($countryOfSupplyOfGoods)
    {
        $this->countryOfSupplyOfGoods = $countryOfSupplyOfGoods;
    }

    /**
     * @param \Dreceiptx\Receipt\LineItem\LineItem[] $invoiceLineItem
     */
    public function setInvoiceLineItem(array $invoiceLineItem)
    {
        $this->invoiceLineItem = $invoiceLineItem;
    }

    /**
     * @param ReceiptAllowanceCharge[] $invoiceAllowanceCharge
     */
    public function setInvoiceAllowanceCharge(array $invoiceAllowanceCharge)
    {
        $this->invoiceAllowanceCharge = $invoiceAllowanceCharge;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\LocationInformation $shipFrom
     */
    public function setShipFrom($shipFrom)
    {
        $this->shipFrom = $shipFrom;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\LocationInformation $shipTo
     */
    public function setShipTo($shipTo)
    {
        $this->shipTo = $shipTo;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\DespatchInformation $despatchInformation
     */
    public function setDespatchInformation($despatchInformation)
    {
        $this->despatchInformation = $despatchInformation;
    }

    /**
     * @param InvoiceSummary $invoiceTotals
     */
    public function getInvoiceTotals($invoiceTotals)
    {
        // TODO create invoice totals
        $this->invoiceTotals = $invoiceTotals;
    }

    /**
     * @param Identification $salesOrder
     */
    public function setSalesOrder($salesOrder)
    {
        $this->salesOrder = $salesOrder;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->documentStatusCode = $this->documentStatusCode;
        $ret->invoiceType = $this->invoiceType;
        $ret->seller = $this->seller;
        $ret->billTo = $this->billTo;
        $ret->purchaseOrder = $this->purchaseOrder;
        $ret->customerReference = $this->customerReference;
        $ret->invoiceIdentification  = $this->invoiceIdentification;
        $ret->creationDateTime  = $this->creationDateTime;
        $ret->invoiceCurrencyCode  = $this->invoiceCurrencyCode;
        $ret->countryOfSupplyOfGoods  = $this->countryOfSupplyOfGoods;
        $ret->invoiceLineItem = $this->invoiceLineItem;
        $ret->invoiceAllowanceCharge = $this->invoiceAllowanceCharge;
        $ret->shipFrom = $this->shipFrom;
        $ret->shipTo = $this->shipTo;
        $ret->despatchInformation = $this->despatchInformation;
        $ret->invoiceTotals = $this->invoiceTotals;
        $ret->salesOrder = $this->salesOrder;
        return $ret;
    }
}