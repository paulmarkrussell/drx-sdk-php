<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;

class DutyFeeTaxRegistration implements \JsonSerializable
{
    private $dutyFeeTaxTypeCode;
    private $dutyFeeTaxRegistationID;

    /**
     * @param string $dutyFeeTaxTypeCode
     */
    public function setDutyFeeTaxTypeCode($dutyFeeTaxTypeCode)
    {
        $this->dutyFeeTaxTypeCode = $dutyFeeTaxTypeCode;
    }

    /**
     * @param string $dutyFeeTaxRegistationID
     */
    public function setDutyFeeTaxRegistationID($dutyFeeTaxRegistationID)
    {
        $this->dutyFeeTaxRegistationID = $dutyFeeTaxRegistationID;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->dutyFeeTaxTypeCode = $this->dutyFeeTaxTypeCode;
        $ret->dutyFeeTaxRegistationID = $this->dutyFeeTaxRegistationID;
        return $ret;
    }
}