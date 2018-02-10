<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Invoice;

use Dreceiptx\Receipt\Common\Amount;

require_once __DIR__."/../Common/Amount.php";
require_once __DIR__."/../../Utils/Utils.php";

class InvoiceSummary implements \JsonSerializable
{
    private $totalInvoiceAmount;
    private $totalLineAmountInclusiveAllowancesCharges;
    private $totalTaxAmount;

    /**
     * @param \Dreceiptx\Receipt\Common\Amount $totalInvoiceAmount
     */
    public function setTotalInvoiceAmount($totalInvoiceAmount)
    {
        $this->totalInvoiceAmount = $totalInvoiceAmount;
    }

    /**
     * @return Amount
     */
    public function getTotalInvoiceAmount()
    {
        return $this->totalInvoiceAmount;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Amount $totalLineAmountInclusiveAllowancesCharges
     */
    public function setTotalLineAmountInclusiveAllowancesCharges($totalLineAmountInclusiveAllowancesCharges)
    {
        $this->totalLineAmountInclusiveAllowancesCharges = $totalLineAmountInclusiveAllowancesCharges;
    }

    /**
     * @return Amount
     */
    public function getTotalLineAmountInclusiveAllowancesCharges()
    {
        return $this->totalLineAmountInclusiveAllowancesCharges;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Amount $totalTaxAmount
     */
    public function setTotalTaxAmount($totalTaxAmount)
    {
        $this->totalTaxAmount = $totalTaxAmount;
    }

    /**
     * @return Amount
     */
    public function getTotalTaxAmount()
    {
        return $this->totalTaxAmount;
    }

    public function getSubTotal() {
        $total = $this->getTotalInvoiceAmount()->getValue() - $this->getTotalTaxAmount()->getValue();
        return Amount::create($this->getTotalInvoiceAmount()->getCurrencyCode(), $total);
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->totalInvoiceAmount = $this->totalInvoiceAmount;
        $ret->totalLineAmountInclusiveAllowancesCharges = $this->totalLineAmountInclusiveAllowancesCharges;
        $ret->totalTaxAmount = $this->totalTaxAmount;
        return \Utils::removeNullProperties($ret);
    }
}