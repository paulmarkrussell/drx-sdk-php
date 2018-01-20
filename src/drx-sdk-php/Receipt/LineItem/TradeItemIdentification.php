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

    /**
     * @param string $additionalTradeItemIdentificationType
     */
    public function setAdditionalTradeItemIdentificationType($additionalTradeItemIdentificationType)
    {
        $this->additionalTradeItemIdentificationType = $additionalTradeItemIdentificationType;
    }

    /**
     * @param string $additionalTradeItemIdentificationValue
     */
    public function setAdditionalTradeItemIdentificationValue($additionalTradeItemIdentificationValue)
    {
        $this->additionalTradeItemIdentificationValue = $additionalTradeItemIdentificationValue;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->additionalTradeItemIdentificationType = $this->additionalTradeItemIdentificationType;
        $ret->additionalTradeItemIdentificationValue = $this->additionalTradeItemIdentificationValue;
        return \Utils::removeNullProperties($ret);
    }
}