<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Ecom;
require_once __DIR__."/../../Utils/Utils.php";

class AVP implements \JsonSerializable
{
    private $attributeName;
    private $qualifierCodeList;
    private $qualifierCodeListVersion;
    private $value;

    /**
     * @param string $key
     * @param string $value
     * @return AVP
     */
    public static function create($key, $value) {
        $item = new AVP();
        $item->attributeName = $key;
        $item->value = $value;
        return $item;
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $qualifierCodeList
     * @param string $qualifierCodeListVersion
     * @return AVP
     */
    public static function createWithQualifier($key, $value, $qualifierCodeList, $qualifierCodeListVersion) {
        $item = new AVP();
        $item->attributeName = $key;
        $item->value = $value;
        $item->qualifierCodeList = $qualifierCodeList;
        $item->qualifierCodeListVersion = $qualifierCodeListVersion;
        return $item;
    }

    /**
     * @param string $attributeName
     */
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;
    }

    /**
     * @return string
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * @param string $qualifierCodeList
     */
    public function setQualifierCodeList($qualifierCodeList)
    {
        $this->qualifierCodeList = $qualifierCodeList;
    }

    /**
     * @return string
     */
    public function getQualifierCodeList()
    {
        return $this->qualifierCodeList;
    }

    /**
     * @param string $qualifierCodeListVersion
     */
    public function setQualifierCodeListVersion($qualifierCodeListVersion)
    {
        $this->qualifierCodeListVersion = $qualifierCodeListVersion;
    }

    /**
     * @return string
     */
    public function getQualifierCodeListVersion()
    {
        return $this->qualifierCodeListVersion;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->attributeName = $this->attributeName;
        $ret->qualifierCodeList = $this->qualifierCodeList;
        $ret->qualifierCodeListVersion = $this->qualifierCodeListVersion;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}