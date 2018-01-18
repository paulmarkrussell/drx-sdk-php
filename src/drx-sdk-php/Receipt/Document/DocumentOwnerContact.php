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

class DocumentOwnerContact implements \JsonSerializable
{
    private $receiptContactType;
    private $personName;
    private $communicationChannelCode;

    /**
     * @param string $receiptContactType
     */
    public function setReceiptContactType($receiptContactType)
    {
        $this->receiptContactType = $receiptContactType;
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
        $ret->receiptContactType = $this->receiptContactType;
        $ret->personName = $this->personName;
        $ret->communicationChannelCode = $this->communicationChannelCode;
        return $ret;
    }
}