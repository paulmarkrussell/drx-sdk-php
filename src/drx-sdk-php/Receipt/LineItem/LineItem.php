<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\LineItem;

use Dreceiptx\Receipt\Common\DespatchInformation;
use Dreceiptx\Receipt\Common\LocationInformation;
use Dreceiptx\Receipt\Common\Measurements\TradeItemMeasurements;
use Dreceiptx\Receipt\Ecom\AVP;

require_once __DIR__."/../Tax/Tax.php";
require_once __DIR__."/../Ecom/AVP.php";
require_once __DIR__."/../Common/Measurements/Measurement.php";
require_once __DIR__."/../Invoice/Identification.php";
require_once __DIR__."/../Common/LocationInformation.php";
require_once __DIR__ . "/TransactionalTradeItem.php";
require_once __DIR__."/../../Utils/Utils.php";

class LineItem implements \JsonSerializable
{

    const LINE_ITEM_TYPE_IDENTIFIER = "DRX_LINEITEM_TYPE";

    private $lineItemNumber;
    private $creditLineIndicator;
    private $creditReason;
    private $amountExclusiveAllowancesCharges;
    private $amountInclusiveAllowancesCharges;
    private $invoicedQuantity;
    private $itemPriceExclusiveAllowancesCharges;
    private $note;
    private $billingCostCentre;
    /** @var TransactionalTradeItem $transactionalTradeItem */
    private $transactionalTradeItem;
    private $invoiceAllowanceCharge;
    private $invoiceLineTaxInformation;
    /** @var AVP[] $despatchInformation */
    private $avpList;
    private $shipFrom;
    private $shipTo;
    /** @var DespatchInformation $despatchInformation */
    private $despatchInformation;

    /**
     * @param integer $lineItemNumber
     */
    public function setLineItemNumber($lineItemNumber)
    {
        $this->lineItemNumber = $lineItemNumber;
    }

    /**
     * @return integer
     */
    public function getLineItemNumber()
    {
        return $this->lineItemNumber;
    }

    /**
     * @param boolean $creditLineIndicator
     */
    public function setCreditLineIndicator($creditLineIndicator)
    {
        $this->creditLineIndicator = $creditLineIndicator;
    }

    /**
     * @return boolean
     */
    public function getCreditLineIndicator()
    {
        return $this->creditLineIndicator;
    }

    /**
     * @param string $creditReason
     */
    public function setCreditReason($creditReason)
    {
        $this->creditReason = $creditReason;
    }

    /**
     * @return string
     */
    public function getCreditReason()
    {
        return $this->creditReason;
    }

    /**
     * @param double $amountExclusiveAllowancesCharges
     */
    public function setAmountExclusiveAllowancesCharges($amountExclusiveAllowancesCharges)
    {
        $this->amountExclusiveAllowancesCharges = $amountExclusiveAllowancesCharges;
    }

    /**
     * @return double
     */
    public function getAmountExclusiveAllowancesCharges()
    {
        return $this->amountExclusiveAllowancesCharges;
    }

    /**
     * @param double $amountInclusiveAllowancesCharges
     */
    public function setAmountInclusiveAllowancesCharges($amountInclusiveAllowancesCharges)
    {
        $this->amountInclusiveAllowancesCharges = $amountInclusiveAllowancesCharges;
    }

    /**
     * @return double
     */
    public function getAmountInclusiveAllowancesCharges()
    {
        return $this->amountInclusiveAllowancesCharges;
    }

    /**
     * @param double $invoicedQuantity
     */
    public function setInvoicedQuantity($invoicedQuantity)
    {
        $this->invoicedQuantity = $invoicedQuantity;
    }

    /**
     * @return double
     */
    public function getInvoicedQuantity()
    {
        return $this->invoicedQuantity;
    }

    /**
     * @param double $itemPriceExclusiveAllowancesCharges
     */
    public function setItemPriceExclusiveAllowancesCharges($itemPriceExclusiveAllowancesCharges)
    {
        $this->itemPriceExclusiveAllowancesCharges = $itemPriceExclusiveAllowancesCharges;
    }

    /**
     * @return double
     */
    public function getItemPriceExclusiveAllowancesCharges()
    {
        return $this->itemPriceExclusiveAllowancesCharges;
    }

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param BillingCostCentre $billingCostCentre
     */
    public function setBillingCostCentre($billingCostCentre)
    {
        $this->billingCostCentre = $billingCostCentre;
    }

    /**
     * @return BillingCostCentre
     */
    public function getBillingCostCentre()
    {
        return $this->billingCostCentre;
    }

    /**
     * @return BillingCostCentre
     */
    public function getBillingCostCentreNotNull()
    {
        if ($this->billingCostCentre == null) {
            $this->billingCostCentre = new BillingCostCentre();
        }
        return $this->billingCostCentre;
    }

    /**
     * @param TransactionalTradeItem $transactionalTradeItem
     */
    public function setTransactionalTradeItem($transactionalTradeItem)
    {
        $this->transactionalTradeItem = $transactionalTradeItem;
    }

    /**
     * @return TransactionalTradeItem
     */
    public function getTransactionalTradeItem()
    {
        return $this->transactionalTradeItem;
    }

    /**
     * @return TransactionalTradeItem
     */
    public function getTransactionalTradeItemNotNull()
    {
        if($this->transactionalTradeItem == null) {
            $this->transactionalTradeItem = new TransactionalTradeItem();
        }
        return $this->transactionalTradeItem;
    }

    public function setBrandName($brandName) {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->setBrandName($brandName);
    }

    public function getBrandName() {
        if ($this->transactionalTradeItem == null) {
            return null;
        }
        if($this->transactionalTradeItem->getTradeItemDescriptionInformation() == null) {
            return null;
        }
        return $this->transactionalTradeItem->getTradeItemDescriptionInformation()->getBrandName();
    }
    /**
     * @param \Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge[] $invoiceAllowanceCharge
     */
    public function setInvoiceAllowanceCharge(array $invoiceAllowanceCharge)
    {
        $this->invoiceAllowanceCharge = $invoiceAllowanceCharge;
    }

    /**
     * @return \Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge[]
     */
    public function getInvoiceAllowanceCharge()
    {
        return $this->invoiceAllowanceCharge;
    }

    /**
     * @param \Dreceiptx\Receipt\Tax\Tax[] $invoiceLineTaxInformation
     */
    public function setInvoiceLineTaxInformation(array $invoiceLineTaxInformation)
    {
        $this->invoiceLineTaxInformation = $invoiceLineTaxInformation;
    }

    /**
     * @return \Dreceiptx\Receipt\Tax\Tax[]
     */
    public function getInvoiceLineTaxInformation()
    {
        if ($this->invoiceLineTaxInformation == null) {
            $this->invoiceLineTaxInformation = array();
        }
        return $this->invoiceLineTaxInformation;
    }

    /**
     * @param \Dreceiptx\Receipt\Ecom\AVP[] $avpList
     */
    public function setAvpList(array $avpList)
    {
        $this->avpList = $avpList;
    }

    public function getValue($key) {
        if($this->avpList == null) {
            return null;
        }
        foreach ($this->avpList as $avpItem) {
            if ($avpItem->getAttributeName() == $key) {
                return $avpItem->getValue();
            }
        }
        return null;
    }

    public function setValue($key, $value) {
        if ($this->avpList == null) {
            $this->avpList = array();
        }
        for ($i = 0; $i < count($this->avpList); $i++) {
            $avpItem = $this->avpList[$i];
            if ($avpItem->getAttributeName() == $key) {
                if ($value == null) {
                    array_splice($this->avpList, $i, 1);
                } else {
                    $avpItem->setValue($value);
                }
                return;
            }
        }
        if ($value != null) {
            array_push($this->avpList, AVP::create($key, $value));
        }
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
     * @return LocationInformation
     */
    public function getShipToNotNull()
    {
        if($this->shipTo == null) {
            $this->shipTo = new LocationInformation();
        }
        return $this->shipTo;
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
     * @return LocationInformation
     */
    public function getShipFromNotNull()
    {
        if($this->shipFrom == null) {
            $this->shipFrom = new LocationInformation();
        }
        return $this->shipFrom;
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
     * @return DespatchInformation
     */
    public function getDespatchInformationNotNull()
    {
        if($this->despatchInformation == null) {
            $this->despatchInformation = new DespatchInformation();
        }
        return $this->despatchInformation;
    }

    public function setDespatchDate($date) {
        $this->getDespatchInformationNotNull()->setDespatchDateTime($date);
    }

    public function getDespatchDate() {
        if($this->despatchInformation == null) {
            return null;
        }
        return $this->despatchInformation->getDespatchDateTime();
    }

    public function setDeliveryDate($date) {
        $this->getDespatchInformationNotNull()->setDespatchDateTime($date);
    }

    public function getDeliveryDate() {
        if($this->despatchInformation == null) {
            return null;
        }
        return $this->despatchInformation->getEstimatedDeliveryDateTime();
    }

    public function setSerialNumber($serialNumber) {
        $this->getTransactionalTradeItemNotNull()->getTransactionItemDataNotNull()->setSerialNumber($serialNumber);
    }

    public function getSerialNumber() {
        if ($this->transactionalTradeItem == null) {
                        return null;
        }
        if ($this->transactionalTradeItem->getTransactionItemData() == null) {
            return null;
        }
        return $this->transactionalTradeItem->getTransactionItemData()->getSerialNumber();    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->lineItemNumber = $this->lineItemNumber;
        $ret->creditLineIndicator = $this->creditLineIndicator;
        $ret->creditReason = $this->creditReason;
        $ret->amountExclusiveAllowancesCharges = $this->amountExclusiveAllowancesCharges;
        $ret->amountInclusiveAllowancesCharges = $this->amountInclusiveAllowancesCharges;
        $ret->invoicedQuantity = $this->invoicedQuantity;
        $ret->itemPriceExclusiveAllowancesCharges = $this->itemPriceExclusiveAllowancesCharges;
        $ret->note = $this->note;
        $ret->billingCostCentre = $this->billingCostCentre;
        $ret->transactionalTradeItem = $this->transactionalTradeItem;
        $ret->invoiceAllowanceCharge = $this->invoiceAllowanceCharge;
        $ret->invoiceLineTaxInformation = $this->invoiceLineTaxInformation;
        $ret->avpList = $this->avpList;
        $ret->shipFrom = $this->shipFrom;
        $ret->shipTo = $this->shipTo;
        $ret->despatchInformation = $this->despatchInformation;
        return \Utils::removeNullProperties($ret);
    }
}