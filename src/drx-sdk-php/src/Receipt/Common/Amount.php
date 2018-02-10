<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/../../Utils/Utils.php";

class Amount implements \JsonSerializable
{
    private $currencyCode;
    private $value;

    /**
     * @param string $code
     * @param double $value
     * @return Amount
     */
    public static function create($code, $value) {
        $amount = new Amount();
        $amount->currencyCode = $code;
        $amount->value = $value;
        return $amount;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param double $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return double
     */
    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->currencyCode = $this->currencyCode;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}