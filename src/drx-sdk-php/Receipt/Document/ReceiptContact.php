<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 16:05
 */

namespace Dreceiptx\Receipt\Document;

require_once __DIR__."/ReceiptContactType.php";
require_once __DIR__."/../Common/Contact.php";
require_once __DIR__."/../../Utils/Utils.php";

class ReceiptContact implements \JsonSerializable
{
    private $contactTypeCode;
    private $personName;
    private $communicationChannelCode;

    /**
     * @param string $contactTypeCode
     */
    public function setContactTypeCode($contactTypeCode)
    {
        $this->contactTypeCode = $contactTypeCode;
    }

    /**
     * @param string $personName
     */
    public function setPersonName($personName)
    {
        $this->personName = $personName;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Contact[] $communicationChannelCode
     */
    public function setCommunicationChannelCode(array $communicationChannelCode)
    {
        $this->communicationChannelCode = $communicationChannelCode;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->contactTypeCode = $this->contactTypeCode;
        $ret->personName = $this->personName;
        $ret->communicationChannelCode = $this->communicationChannelCode;
        return \Utils::removeNullProperties($ret);
    }
}