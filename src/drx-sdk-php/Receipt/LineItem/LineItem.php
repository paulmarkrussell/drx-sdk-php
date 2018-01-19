<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\LineItem;

require_once __DIR__."/../Tax/Tax.php";
require_once __DIR__."/../Ecom/AVP.php";
require_once __DIR__."/../Common/Measurements/Measurement.php";
require_once __DIR__."/../Invoice/Identification.php";
require_once __DIR__."/../Common/LocationInformation.php";

class LineItem implements \JsonSerializable
{

    private $taxes;
    private $AVPList;
    private $lineItemTypeIdentifier = "DRX_LINEITEM_TYPE";
    private $brandName;
    private $name;
    private $description;
    private $lineItemNumber;
    private $creditLineIndicator;

    private $measurementHeight;
    private $measurementWidth;
    private $measurementDepth;
    private $measurementDiameter;

    private $transactionalTradeItemType;
    private $transactionalTradeItemCode;
    private $tradeItemGroupIdentificationCode;

    private $serialNumber;
    private $batchNumber;
    private $billingCostCentre;
    private $despatchDate;
    private $deliveryDate;
    private $deliveryInstructions;
    private $shipFrom;
    private $shipTo;
    private $note;
    private $amountExclusiveAllowancesCharges;
    private $amountInclusiveAllowancesCharges;
    private $invoiceLineTaxInformation;
    private $invoicedQuantity;
    private $itemPriceExclusiveAllowancesCharges;

    /**
     * @param \Dreceiptx\Receipt\Tax\Tax[] $taxes
     */
    public function setTaxes(array $taxes)
    {
        $this->taxes = $taxes;
    }

    /**
     * @param \Dreceiptx\Receipt\Ecom\AVP[] $AVPList
     */
    public function setAVPList(array $AVPList)
    {
        $this->AVPList = $AVPList;
    }

    /**
     * @param string $brandName
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param integer $lineItemNumber
     */
    public function setLineItemNumber($lineItemNumber)
    {
        $this->lineItemNumber = $lineItemNumber;
    }

    /**
     * @param boolean $creditLineIndicator
     */
    public function setCreditLineIndicator($creditLineIndicator)
    {
        $this->creditLineIndicator = $creditLineIndicator;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Measurements\Measurement $measurementHeight
     */
    public function setMeasurementHeight($measurementHeight)
    {
        $this->measurementHeight = $measurementHeight;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Measurements\Measurement $measurementWidth
     */
    public function setMeasurementWidth($measurementWidth)
    {
        $this->measurementWidth = $measurementWidth;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Measurements\Measurement $measurementDepth
     */
    public function setMeasurementDepth($measurementDepth)
    {
        $this->measurementDepth = $measurementDepth;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Measurements\Measurement $measurementDiameter
     */
    public function setMeasurementDiameter($measurementDiameter)
    {
        $this->measurementDiameter = $measurementDiameter;
    }

    /**
     * @param string $tradeItemGroupIdentificationCode
     */
    public function setTradeItemGroupIdentificationCode($tradeItemGroupIdentificationCode)
    {
        $this->tradeItemGroupIdentificationCode = $tradeItemGroupIdentificationCode;
    }

    /**
     * @param string $transactionalTradeItemType
     */
    public function setTransactionalTradeItemType($transactionalTradeItemType)
    {
        $this->transactionalTradeItemType = $transactionalTradeItemType;
    }

    /**
     * @param string $transactionalTradeItemCode
     */
    public function setTransactionalTradeItemCode($transactionalTradeItemCode)
    {
        $this->transactionalTradeItemCode = $transactionalTradeItemCode;
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @param string $batchNumber
     */
    public function setBatchNumber($batchNumber)
    {
        $this->batchNumber = $batchNumber;
    }

    /**
     * @param \Dreceiptx\Receipt\Invoice\Identification $billingCostCentre
     */
    public function setBillingCostCentre($billingCostCentre)
    {
        $this->billingCostCentre = $billingCostCentre;
    }

    /**
     * @param \DateTime $despatchDate
     */
    public function setDespatchDate($despatchDate)
    {
        $this->despatchDate = $despatchDate;
    }

    /**
     * @param \DateTime $deliveryDate
     */
    public function setDeliveryDate($deliveryDate)
    {
        $this->deliveryDate = $deliveryDate;
    }

    /**
     * @param string $deliveryInstructions
     */
    public function setDeliveryInstructions($deliveryInstructions)
    {
        $this->deliveryInstructions = $deliveryInstructions;
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
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @param double $amountExclusiveAllowancesCharges
     */
    public function setAmountExclusiveAllowancesCharges($amountExclusiveAllowancesCharges)
    {
        $this->amountExclusiveAllowancesCharges = $amountExclusiveAllowancesCharges;
    }

    /**
     * @param double $amountInclusiveAllowancesCharges
     */
    public function setAmountInclusiveAllowancesCharges($amountInclusiveAllowancesCharges)
    {
        $this->amountInclusiveAllowancesCharges = $amountInclusiveAllowancesCharges;
    }

    /**
     * @param \Dreceiptx\Receipt\Tax\Tax[] $invoiceLineTaxInformation
     */
    public function setInvoiceLineTaxInformation($invoiceLineTaxInformation)
    {
        $this->invoiceLineTaxInformation = $invoiceLineTaxInformation;
    }

    /**
     * @param double $invoicedQuantity
     */
    public function setInvoicedQuantity($invoicedQuantity)
    {
        $this->invoicedQuantity = $invoicedQuantity;
    }

    /**
     * @param double $itemPriceExclusiveAllowancesCharges
     */
    public function setItemPriceExclusiveAllowancesCharges($itemPriceExclusiveAllowancesCharges)
    {
        $this->itemPriceExclusiveAllowancesCharges = $itemPriceExclusiveAllowancesCharges;
    }



    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->name = $this->name;
        $ret->description = $this->description;
        $ret->lineItemNumber = $this->lineItemNumber;
        $ret->creditLineIndicator = $this->creditLineIndicator;

        $ret->measurementHeight = $this->measurementHeight;
        $ret->measurementWidth = $this->measurementWidth;
        $ret->measurementDepth = $this->measurementDepth;
        $ret->measurementDiameter = $this->measurementDiameter;

        $ret->transactionalTradeItemType = $this->transactionalTradeItemType;
        $ret->transactionalTradeItemCode = $this->transactionalTradeItemCode;
        $ret->tradeItemGroupIdentificationCode = $this->tradeItemGroupIdentificationCode;

        $ret->serialNumber = $this->serialNumber;
        $ret->batchNumber = $this->batchNumber;
        $ret->billingCostCentre = $this->billingCostCentre;
        $ret->despatchDate = $this->despatchDate;
        $ret->deliveryDate = $this->deliveryDate;
        $ret->deliveryInstructions = $this->deliveryInstructions;
        $ret->shipFrom = $this->shipFrom;
        $ret->shipTo = $this->shipTo;
        $ret->note = $this->note;
        $ret->amountExclusiveAllowancesCharges = $this->amountExclusiveAllowancesCharges;
        $ret->amountInclusiveAllowancesCharges = $this->amountInclusiveAllowancesCharges;
        $ret->invoiceLineTaxInformation = $this->invoiceLineTaxInformation;
        $ret->invoicedQuantity = $this->invoicedQuantity;
        $ret->itemPriceExclusiveAllowancesCharges = $this->itemPriceExclusiveAllowancesCharges;

        return $ret;
    }
}