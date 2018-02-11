<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:26
 */

namespace Dreceiptx\Receipt\Invoice;

use Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType;
use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\Common\Amount;
use Dreceiptx\Receipt\Common\DespatchInformation;
use Dreceiptx\Receipt\Common\LocationInformation;
use Dreceiptx\Receipt\Common\TransactionalParty;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\LineItem\LineItemFactory;

require_once __DIR__."/../LineItem/LineItem.php";
require_once __DIR__."/../AllowanceCharge/ReceiptAllowanceCharge.php";
require_once __DIR__."/../Common/DespatchInformation.php";
require_once __DIR__."/../Common/LocationInformation.php";
require_once __DIR__."/../Common/TransactionalParty.php";

require_once __DIR__."/Identification.php";
require_once __DIR__."/InvoiceSummary.php";
require_once __DIR__."/../../Utils/Utils.php";
require_once __DIR__."/../LineItem/LineItemFactory.php";

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
        $typedLineItems = array();
        foreach ($invoiceLineItem as $item){
            array_push($typedLineItems, \Dreceiptx\Receipt\LineItem\LineItemFactory::getTypedLineItem($item));
        }
        $this->invoiceLineItem = $typedLineItems;
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
     * @param LineItem $lineItem
     */
    public function addLineItem($lineItem) {
        if($this->invoiceLineItem == null) {
            $this->invoiceLineItem = array();
        }
        $count = sizeof($this->invoiceLineItem);
        $lineItem->setLineItemNumber($count);
        array_push($this->invoiceLineItem, \Dreceiptx\Receipt\LineItem\LineItemFactory::getTypedLineItem($lineItem));
        return $count;
    }

    public function removeLineItem($index) {
        array_splice($this->invoiceLineItem, $index, 1);
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
     * @param ReceiptAllowanceCharge $allowanceCharge
     */
    public function addAllowanceCharge($allowanceCharge) {
        if($this->invoiceAllowanceCharge == null) {
            $this->invoiceAllowanceCharge = array();
        }
        $index = count($this->invoiceAllowanceCharge);
        array_push($this->invoiceAllowanceCharge, $allowanceCharge);
        return $index;
    }

    public function removeAllowanceCharge($index) {
        array_splice($this->invoiceAllowanceCharge, $index, 1);
    }

    public function addCreateAllowanceCharge(
        $allowanceOrChargeType,
        $allowanceChargeType,
        $baseAmount,
        $leviedDutyFeeTax,
        $settlementType,
        $allowanceChargeDescription){
        if($this->invoiceAllowanceCharge == null) {
            $this->invoiceAllowanceCharge = array();
        }
        array_push($this->invoiceAllowanceCharge,
                ReceiptAllowanceCharge::create(
                        $allowanceOrChargeType,
                        $allowanceChargeType,
                        $baseAmount,
                        $leviedDutyFeeTax,
                        $settlementType,
                        $allowanceChargeDescription)
        );
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
        $this->calculateTotals();
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
        return $this->salesOrder;
    }

    /**
     * @return InvoiceSummary
     */
    private function calculateTotals() {
        $this->invoiceTotals = new InvoiceSummary();
        $netTotal = 0;
        $totalTax = 0;
        foreach ($this->getInvoiceLineItem() as $lineItem) {
            $itemPrice = $lineItem->getInvoicedQuantity() * $lineItem->getItemPriceExclusiveAllowancesCharges();
            $netTotal += $itemPrice;
            $totalTax += $this->calculateItemTax($itemPrice, $lineItem->getInvoiceLineTaxInformation());
        }
        foreach ($this->getInvoiceAllowanceCharge() as $allowanceCharge) {
            $itemPrice = $allowanceCharge->getBaseAmount();
            if($allowanceCharge->getAllowanceOrChargeType() == AllowanceOrChargeType::ALLOWANCE) {
                $itemPrice = -$itemPrice;
            }
            $netTotal += $itemPrice;
            $totalTax += $this->calculateItemTax($itemPrice, $allowanceCharge->getLeviedDutyFeeTax());
        }
        $this->invoiceTotals->setTotalInvoiceAmount(Amount::create($this->getInvoiceCurrencyCode(), $netTotal + $totalTax));
        $this->invoiceTotals->setTotalLineAmountInclusiveAllowancesCharges(Amount::create($this->getInvoiceCurrencyCode(), $netTotal + $totalTax));
        $this->invoiceTotals->setTotalTaxAmount(Amount::create($this->getInvoiceCurrencyCode(), $totalTax));
    }

    private function calculateItemTax($baseAmount, $taxes) {
        $itemTax = 0;
        foreach ($taxes as $tax) {
            $tax->setDutyFeeTaxBasisAmount($baseAmount);
            $itemTax += $tax->getDutyFeeTaxAmount();
        }
        return $itemTax;
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
        $ret->creationDateTime  = $this->creationDateTime->format("Y-m-d\TH:i:sO");
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