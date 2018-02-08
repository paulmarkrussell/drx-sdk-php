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
     * @param string $communicationChannelCode
     * @param string $communicationValue
     * @return Contact
     */
    public static function create($communicationChannelCode, $communicationValue) {
        $contact = new Contact();
        $contact->communicationChannelCode = $communicationChannelCode;
        $contact->communicationValue = $communicationValue;
        return $contact;
    }
    /**
     * @param string $communicationChannelCode
     */
    public function setCommunicationChannelCode($communicationChannelCode)
    {
        $this->communicationChannelCode = $communicationChannelCode;
    }

    /**
     * @return string
     */
    public function getCommunicationChannelCode()
    {
        return $this->communicationChannelCode;
    }

    /**
     * @param string $communicationValue
     */
    public function setCommunicationValue($communicationValue)
    {
        $this->communicationValue = $communicationValue;
    }

    /**
     * @return string
     */
    public function getCommunicationValue()
    {
        return $this->communicationValue;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->communicationChannelCode = $this->communicationChannelCode;
        $ret->communicationValue = $this->communicationValue;
        return \Utils::removeNullProperties($ret);
    }
}