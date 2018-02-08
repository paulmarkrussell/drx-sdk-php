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

    public static function create($key, $value) {
        $item = new AVP();
        $item->setAttributeName($key);
        $item->setValue($value);
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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
     * @return mixed
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