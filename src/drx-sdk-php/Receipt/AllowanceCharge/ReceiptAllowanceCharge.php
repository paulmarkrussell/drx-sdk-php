<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\AllowanceCharge;

require_once __DIR__."/../Tax/Tax.php";
require_once __DIR__."/../../Utils/Utils.php";

class ReceiptAllowanceCharge implements \JsonSerializable
{
    private $allowanceOrChargeType;
    private $allowanceChargeType;
    private $baseAmount;
    private $leviedDutyFeeTax;
    private $settlementType ;
    private $allowanceChargeDescription;

    /**
     * @param string $allowanceOrChargeType
     */
    public function setAllowanceOrChargeType($allowanceOrChargeType)
    {
        $this->allowanceOrChargeType = $allowanceOrChargeType;
    }

    /**
     * @param string $allowanceChargeType
     */
    public function setAllowanceChargeType($allowanceChargeType)
    {
        $this->allowanceChargeType = $allowanceChargeType;
    }

    /**
     * @param double $baseAmount
     */
    public function setBaseAmount($baseAmount)
    {
        $this->baseAmount = $baseAmount;
    }

    /**
     * @param \Dreceiptx\Receipt\Tax\Tax[] $leviedDutyFeeTax
     */
    public function setLeviedDutyFeeTax(array $leviedDutyFeeTax)
    {
        $this->leviedDutyFeeTax = $leviedDutyFeeTax;
    }

    /**
     * @param string $settlementType
     */
    public function setSettlementType($settlementType)
    {
        $this->settlementType = $settlementType;
    }

    /**
     * @param string $allowanceChargeDescription
     */
    public function setAllowanceChargeDescription($allowanceChargeDescription)
    {
        $this->allowanceChargeDescription = $allowanceChargeDescription;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->allowanceOrChargeType = $this->allowanceOrChargeType;
        $ret->allowanceChargeType = $this->allowanceChargeType;
        $ret->baseAmount = $this->baseAmount;
        $ret->leviedDutyFeeTax = $this->leviedDutyFeeTax;
        $ret->settlementType = $this->settlementType;
        $ret->allowanceChargeDescription = $this->allowanceChargeDescription;
        return \Utils::removeNullProperties($ret);
    }
}