<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;

require_once __DIR__ . "/../../Utils/Utils.php";
require_once __DIR__."/../Common/Amount.php";

class SettlementLineItem implements \JsonSerializable
{
    private $lineItemNumber;
    private $amountPaid;
    private $settlementParty;
    private $transactionalReference;

    /**
     * @param integer $lineItemNumber
     */
    public function setLineItemNumber($lineItemNumber)
    {
        $this->lineItemNumber = $lineItemNumber;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Amount $amountPaid
     */
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;
    }

    /**
     * @param SettlementParty $settlementParty
     */
    public function setSettlementParty($settlementParty)
    {
        $this->settlementParty = $settlementParty;
    }

    /**
     * @param TransactionalReference[] $transactionalReference
     */
    public function setTransactionalReference(array $transactionalReference)
    {
        $this->transactionalReference = $transactionalReference;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->lineItemNumber = $this->lineItemNumber;
        $ret->amountPaid = $this->amountPaid;
        $ret->settlementParty = $this->settlementParty;
        $ret->transactionalReference = $this->transactionalReference;
        return \Utils::removeNullProperties($ret);
    }
}