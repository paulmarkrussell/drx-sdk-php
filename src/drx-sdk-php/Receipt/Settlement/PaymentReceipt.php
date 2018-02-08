<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__."/../../Utils/Utils.php";

class PaymentReceipt implements \JsonSerializable
{

    private $settlementCurrency;
    private $settlementIdentification;
    private $settlementHandlingTypeCode;
    private $totalAmount;
    private $paymentMethod;
    private $payee;
    private $payer;
    private $settlementLineItem;

    /**
     * @param string $settlementCurrency
     */
    public function setSettlementCurrency($settlementCurrency)
    {
        $this->settlementCurrency = $settlementCurrency;
    }

    /**
     * @return string
     */
    public function getSettlementCurrency()
    {
        return $this->settlementCurrency;
    }

    /**
     * @param string $settlementIdentification
     */
    public function setSettlementIdentification($settlementIdentification)
    {
        $this->settlementIdentification = $settlementIdentification;
    }

    /**
     * @return string
     */
    public function getSettlementIdentification()
    {
        return $this->settlementIdentification;
    }

    /**
     * @param string $settlementHandlingTypeCode
     */
    public function setSettlementHandlingTypeCode($settlementHandlingTypeCode)
    {
        $this->settlementHandlingTypeCode = $settlementHandlingTypeCode;
    }

    /**
     * @return string
     */
    public function getSettlementHandlingTypeCode()
    {
        return $this->settlementHandlingTypeCode;
    }

    /**
     * @param double $totalAmount
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

    /**
     * @return double
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * @param PaymentMethod $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return PaymentMethod
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param Payee $payee
     */
    public function setPayee($payee)
    {
        $this->payee = $payee;
    }

    /**
     * @return Payee
     */
    public function getPayee()
    {
        return $this->payee;
    }

    /**
     * @param Payer $payer
     */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

    /**
     * @return Payer
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * @param SettlementLineItem[] $settlementLineItem
     */
    public function setSettlementLineItem(array $settlementLineItem)
    {
        if($this->settlementLineItem == null) {
            $this->settlementLineItem = array();
        }
        $this->settlementLineItem = $settlementLineItem;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->settlementCurrency = $this->settlementCurrency;
        $ret->settlementIdentification = $this->settlementIdentification;
        $ret->settlementHandlingTypeCode = $this->settlementHandlingTypeCode;
        $ret->totalAmount = $this->totalAmount;
        $ret->paymentMethod = $this->paymentMethod;
        $ret->payee = $this->payee;
        $ret->payer = $this->payer;
        $ret->settlementLineItem = $this->settlementLineItem;
        return \Utils::removeNullProperties($ret);
    }
}