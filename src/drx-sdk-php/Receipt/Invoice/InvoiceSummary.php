<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Invoice;

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
     * @param \Dreceiptx\Receipt\Common\Amount $totalLineAmountInclusiveAllowancesCharges
     */
    public function setTotalLineAmountInclusiveAllowancesCharges($totalLineAmountInclusiveAllowancesCharges)
    {
        $this->totalLineAmountInclusiveAllowancesCharges = $totalLineAmountInclusiveAllowancesCharges;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Amount $totalTaxAmount
     */
    public function setTotalTaxAmount($totalTaxAmount)
    {
        $this->totalTaxAmount = $totalTaxAmount;
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