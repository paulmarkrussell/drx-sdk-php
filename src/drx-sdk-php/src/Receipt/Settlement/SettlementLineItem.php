<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;

use Dreceiptx\Receipt\Common\Amount;

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
     * @return integer
     */
    public function getLineItemNumber()
    {
        return $this->lineItemNumber;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Amount $amountPaid
     */
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;
    }

    /**
     * @return Amount
     */
    public function getAmountPaid()
    {
        return $this->amountPaid;
    }

    /**
     * @return Amount
     */
    public function getAmountPaidNotNull()
    {
        if($this->amountPaid == null) {
            $this->amountPaid = new Amount();
        }
        return $this->amountPaid;
    }

    /**
     * @param SettlementParty $settlementParty
     */
    public function setSettlementParty($settlementParty)
    {
        $this->settlementParty = $settlementParty;
    }

    /**
     * @return SettlementParty
     */
    public function getSettlementParty()
    {
        return $this->settlementParty;
    }

    /**
     * @return SettlementParty
     */
    public function getSettlementPartyNotNull()
    {
        if($this->settlementParty == null) {
            $this->settlementParty = new SettlementParty();
        }
        return $this->settlementParty;
    }

    /**
     * @param TransactionalReference[] $transactionalReference
     */
    public function setTransactionalReference(array $transactionalReference)
    {
        $this->transactionalReference = $transactionalReference;
    }

    /**
     * @return TransactionalReference[]
     */
    public function getTransactionalReference()
    {
        if($this->transactionalReference == null) {
            $this->transactionalReference = array();
        }
        return $this->transactionalReference;
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