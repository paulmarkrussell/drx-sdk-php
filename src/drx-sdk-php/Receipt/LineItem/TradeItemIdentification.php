<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 07:51
 */

namespace Dreceiptx\Receipt\LineItem;
require_once __DIR__."/../../Utils/Utils.php";

class TradeItemIdentification implements \JsonSerializable
{

    private $additionalTradeItemIdentificationType;
    private $additionalTradeItemIdentificationValue;

    public static function create($type, $value) {
        $id = new TradeItemIdentification();
        $id->additionalTradeItemIdentificationType = $type;
        $id->additionalTradeItemIdentificationValue = $value;
        return $id;
    }

    /**
     * @param string $additionalTradeItemIdentificationType
     */
    public function setAdditionalTradeItemIdentificationType($additionalTradeItemIdentificationType)
    {
        $this->additionalTradeItemIdentificationType = $additionalTradeItemIdentificationType;
    }

    /**
     * @return string
     */
    public function getAdditionalTradeItemIdentificationType()
    {
        return $this->additionalTradeItemIdentificationType;
    }

    /**
     * @param string $additionalTradeItemIdentificationValue
     */
    public function setAdditionalTradeItemIdentificationValue($additionalTradeItemIdentificationValue)
    {
        $this->additionalTradeItemIdentificationValue = $additionalTradeItemIdentificationValue;
    }

    /**
     * @return string
     */
    public function getAdditionalTradeItemIdentificationValue()
    {
        return $this->additionalTradeItemIdentificationValue;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->additionalTradeItemIdentificationType = $this->additionalTradeItemIdentificationType;
        $ret->additionalTradeItemIdentificationValue = $this->additionalTradeItemIdentificationValue;
        return \Utils::removeNullProperties($ret);
    }
}