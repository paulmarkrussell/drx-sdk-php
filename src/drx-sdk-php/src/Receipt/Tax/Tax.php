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

    public static function create($dutyFeeTaxCategoryCode, $dutyFeeTaxPercentage, $dutyFeeTaxTypeCode) {
        $tax = new Tax();
        $tax->setDutyFeeTaxCategoryCode($dutyFeeTaxCategoryCode);
        $tax->setDutyFeeTaxPercentage($dutyFeeTaxPercentage);
        $tax->setDutyFeeTaxTypeCode($dutyFeeTaxTypeCode);
        return $tax;
    }

    /**
     * @param double $dutyFeeTaxAmount
     */
    public function setDutyFeeTaxAmount($dutyFeeTaxAmount)
    {
        $this->dutyFeeTaxAmount = $dutyFeeTaxAmount;
    }

    /**
     * @return double
     */
    public function getDutyFeeTaxAmount()
    {
        return $this->dutyFeeTaxAmount;
    }

    /**
     * @param double $dutyFeeTaxBasisAmount
     */
    public function setDutyFeeTaxBasisAmount($dutyFeeTaxBasisAmount)
    {
        $this->dutyFeeTaxBasisAmount = $dutyFeeTaxBasisAmount;
        $this->dutyFeeTaxAmount = $this->dutyFeeTaxBasisAmount * $this->getDutyFeeTaxPercentage() / 100.0;
    }

    /**
     * @return double
     */
    public function getDutyFeeTaxBasisAmount()
    {
        return $this->dutyFeeTaxBasisAmount;
    }

    /**
     * @param string $dutyFeeTaxCategoryCode
     */
    public function setDutyFeeTaxCategoryCode($dutyFeeTaxCategoryCode)
    {
        $this->dutyFeeTaxCategoryCode = $dutyFeeTaxCategoryCode;
    }

    /**
     * @return string
     */
    public function getDutyFeeTaxCategoryCode()
    {
        return $this->dutyFeeTaxCategoryCode;
    }

    /**
     * @param double $dutyFeeTaxPercentage
     */
    public function setDutyFeeTaxPercentage($dutyFeeTaxPercentage)
    {
        $this->dutyFeeTaxPercentage = $dutyFeeTaxPercentage;
    }

    /**
     * @return double
     */
    public function getDutyFeeTaxPercentage()
    {
        return $this->dutyFeeTaxPercentage;
    }

    /**
     * @param string $dutyFeeTaxTypeCode
     */
    public function setDutyFeeTaxTypeCode($dutyFeeTaxTypeCode)
    {
        $this->dutyFeeTaxTypeCode = $dutyFeeTaxTypeCode;
    }

    /**
     * @return string
     */
    public function getDutyFeeTaxTypeCode()
    {
        return $this->dutyFeeTaxTypeCode;
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