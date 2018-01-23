<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/../../Utils/Utils.php";

class Contact implements \JsonSerializable
{

    private $communicationChannelCode;
    private $communicationValue;

    /**
     * @param mixed $communicationChannelCode
     */
    public function setCommunicationChannelCode($communicationChannelCode)
    {
        $this->communicationChannelCode = $communicationChannelCode;
    }

    /**
     * @param mixed $communicationValue
     */
    public function setCommunicationValue($communicationValue)
    {
        $this->communicationValue = $communicationValue;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->communicationChannelCode = $this->communicationChannelCode;
        $ret->communicationValue = $this->communicationValue;
        return \Utils::removeNullProperties($ret);
    }
}