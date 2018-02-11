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
    private $baseAmount; // Amount of the allowance or charge
    private $leviedDutyFeeTax; // Taxes on the base amount
    private $settlementType ;
    private $allowanceChargeDescription;

    public static function create(
            $allowanceOrChargeType,
            $allowanceChargeType,
            $baseAmount,
            $leviedDutyFeeTax,
            $settlementType,
            $allowanceChargeDescription){
        if($allowanceOrChargeType != AllowanceOrChargeType::ALLOWANCE && $allowanceOrChargeType != AllowanceOrChargeType::CHARGE) {
            throw new Exception('allowanceOrChargeType must be either '.AllowanceOrChargeType::ALLOWANCE." or ".AllowanceOrChargeType::CHARGE.", but was ".$allowanceOrChargeType);
        }
        $allowanceCharge = new ReceiptAllowanceCharge();
        $allowanceCharge->allowanceOrChargeType = $allowanceOrChargeType;
        $allowanceCharge->allowanceChargeType = $allowanceChargeType;
        $allowanceCharge->baseAmount = $baseAmount;
        $allowanceCharge->leviedDutyFeeTax = $leviedDutyFeeTax;
        $allowanceCharge->settlementType = $settlementType;
        $allowanceCharge->allowanceChargeDescription = $allowanceChargeDescription;
        return $allowanceCharge;
    }

    /**
     * @param string $allowanceOrChargeType
     */
    public function setAllowanceOrChargeType($allowanceOrChargeType)
    {
        $this->allowanceOrChargeType = $allowanceOrChargeType;
    }

    /**
     * @return string
     */
    public function getAllowanceOrChargeType()
    {
        return $this->allowanceOrChargeType;
    }

    /**
     * @param string $allowanceChargeType
     */
    public function setAllowanceChargeType($allowanceChargeType)
    {
        $this->allowanceChargeType = $allowanceChargeType;
    }

    /**
     * @return string
     */
    public function getAllowanceChargeType()
    {
        return $this->allowanceChargeType;
    }

    /**
     * @param double $baseAmount
     */
    public function setBaseAmount($baseAmount)
    {
        $this->baseAmount = $baseAmount;
    }

    /**
     * @return double
     */
    public function getBaseAmount()
    {
        return $this->baseAmount;
    }

    /**
     * @param \Dreceiptx\Receipt\Tax\Tax[] $leviedDutyFeeTax
     */
    public function setLeviedDutyFeeTax(array $leviedDutyFeeTax)
    {
        $this->leviedDutyFeeTax = $leviedDutyFeeTax;
    }

    /**
     * @return Tax[]
     */
    public function getLeviedDutyFeeTax()
    {
        if ($this->leviedDutyFeeTax == null) {
            $this->leviedDutyFeeTax = array();
        }
        return $this->leviedDutyFeeTax;
    }

    /**
     * @param string $settlementType
     */
    public function setSettlementType($settlementType)
    {
        $this->settlementType = $settlementType;
    }

    /**
     * @return string
     */
    public function getSettlementType()
    {
        return $this->settlementType;
    }

    /**
     * @param string $allowanceChargeDescription
     */
    public function setAllowanceChargeDescription($allowanceChargeDescription)
    {
        $this->allowanceChargeDescription = $allowanceChargeDescription;
    }

    /**
     * @return string
     */
    public function getAllowanceChargeDescription()
    {
        return $this->allowanceChargeDescription;
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