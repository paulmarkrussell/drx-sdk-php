<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Ecom;

class AVP implements \JsonSerializable
{
    private $attributeName;
    private $qualifierCodeList;
    private $qualifierCodeListVersion;
    private $value;

    /**
     * @param string $attributeName
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;
    }

    /**
     * @param string $qualifierCodeList
     */
    public function setQualifierCodeList($qualifierCodeList)
    {
        $this->qualifierCodeList = $qualifierCodeList;
    }

    /**
     * @param string $qualifierCodeListVersion
     */
    public function setQualifierCodeListVersion($qualifierCodeListVersion)
    {
        $this->qualifierCodeListVersion = $qualifierCodeListVersion;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->attributeName = $this->attributeName;
        $ret->qualifierCodeList = $this->qualifierCodeList;
        $ret->qualifierCodeListVersion = $this->qualifierCodeListVersion;
        $ret->value = $this->value;
        return $ret;
    }
}