<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-15
 * Time: 07:48
 */

namespace Dreceiptx\Receipt\Tax;
require_once __DIR__."/../../Utils/Utils.php";

class Tax implements \JsonSerializable
{

    private $dutyFeeTaxAmount;
    private $dutyFeeTaxBasisAmount;
    private $dutyFeeTaxCategoryCode;
    private $dutyFeeTaxPercentage;
    private $dutyFeeTaxTypeCode;

    /**
     * @param double $dutyFeeTaxAmount
     */
    public function setDutyFeeTaxAmount($dutyFeeTaxAmount)
    {
        $this->dutyFeeTaxAmount = $dutyFeeTaxAmount;
    }

    /**
     * @param double $dutyFeeTaxBasisAmount
     */
    public function setDutyFeeTaxBasisAmount($dutyFeeTaxBasisAmount)
    {
        $this->dutyFeeTaxBasisAmount = $dutyFeeTaxBasisAmount;
    }

    /**
     * @param string $dutyFeeTaxCategoryCode
     */
    public function setDutyFeeTaxCategoryCode($dutyFeeTaxCategoryCode)
    {
        $this->dutyFeeTaxCategoryCode = $dutyFeeTaxCategoryCode;
    }

    /**
     * @param double $dutyFeeTaxPercentage
     */
    public function setDutyFeeTaxPercentage($dutyFeeTaxPercentage)
    {
        $this->dutyFeeTaxPercentage = $dutyFeeTaxPercentage;
    }

    /**
     * @param string $dutyFeeTaxTypeCode
     */
    public function setDutyFeeTaxTypeCode($dutyFeeTaxTypeCode)
    {
        $this->dutyFeeTaxTypeCode = $dutyFeeTaxTypeCode;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->dutyFeeTaxAmount = $this->dutyFeeTaxAmount;
        $ret->dutyFeeTaxBasisAmount = $this->dutyFeeTaxBasisAmount;
        $ret->dutyFeeTaxCategoryCode = $this->dutyFeeTaxCategoryCode;
        $ret->dutyFeeTaxPercentage = $this->dutyFeeTaxPercentage;
        $ret->dutyFeeTaxTypeCode = $this->dutyFeeTaxTypeCode;
        return \Utils::removeNullProperties($ret);
    }
}