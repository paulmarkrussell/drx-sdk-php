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
require_once __DIR__ . "/TransactionalTradeItem.php";
require_once __DIR__."/../../Utils/Utils.php";

class LineItem implements \JsonSerializable
{

    private $lineItemNumber;
    private $creditLineIndicator;
    private $creditReason;
    private $amountExclusiveAllowancesCharges;
    private $amountInclusiveAllowancesCharges;
    private $invoicedQuantity;
    private $itemPriceExclusiveAllowancesCharges;
    private $note;
    private $billingCostCentre;
    private $transactionalTradeItem;
    private $invoiceAllowanceCharge;
    private $invoiceLineTaxInformation;
    private $AVPList;
    private $shipFrom;
    private $shipTo;
    private $despatchInformation;

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
     * @param string $creditReason
     */
    public function setCreditReason($creditReason)
    {
        $this->creditReason = $creditReason;
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

    /**
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @param BillingCostCentre $billingCostCentre
     */
    public function setBillingCostCentre($billingCostCentre)
    {
        $this->billingCostCentre = $billingCostCentre;
    }

    /**
     * @param TransactionalTradeItem $transactionalTradeItem
     */
    public function setTransactionalTradeItem($transactionalTradeItem)
    {
        $this->transactionalTradeItem = $transactionalTradeItem;
    }

    /**
     * @param \Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge[] $invoiceAllowanceCharge
     */
    public function setInvoiceAllowanceCharge(array $invoiceAllowanceCharge)
    {
        $this->invoiceAllowanceCharge = $invoiceAllowanceCharge;
    }

    /**
     * @param \Dreceiptx\Receipt\Tax\Tax[] $invoiceLineTaxInformation
     */
    public function setInvoiceLineTaxInformation(array $invoiceLineTaxInformation)
    {
        $this->invoiceLineTaxInformation = $invoiceLineTaxInformation;
    }

    /**
     * @param \Dreceiptx\Receipt\Ecom\AVP[] $AVPList
     */
    public function setAVPList(array $AVPList)
    {
        $this->AVPList = $AVPList;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\LocationInformation $shipTo
     */
    public function setShipTo($shipTo)
    {
        $this->shipTo = $shipTo;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\LocationInformation $shipFrom
     */
    public function setShipFrom($shipFrom)
    {
        $this->shipFrom = $shipFrom;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\DespatchInformation $despatchInformation
     */
    public function setDespatchInformation($despatchInformation)
    {
        $this->despatchInformation = $despatchInformation;
    }

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
        $ret->AVPList = $this->AVPList;
        $ret->shipFrom = $this->shipFrom;
        $ret->shipTo = $this->shipTo;
        $ret->despatchInformation = $this->despatchInformation;
        return \Utils::removeNullProperties($ret);
    }
}