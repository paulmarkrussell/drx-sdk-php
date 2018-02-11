<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 16:05
 */

namespace Dreceiptx\Receipt\Document;

use Dreceiptx\Receipt\Common\Contact;

require_once __DIR__."/ReceiptContactType.php";
require_once __DIR__."/../Common/Contact.php";
require_once __DIR__."/../../Utils/Utils.php";

class ReceiptContact implements \JsonSerializable
{
    private $contactTypeCode;
    private $personName;
    private $communicationChannelCode;

    /**
     * @param string $typeCode
     * @param string $personName
     * @return ReceiptContact
     */
    public static function create($typeCode, $personName) {
        $contact = new ReceiptContact();
        $contact->contactTypeCode = $typeCode;
        $contact->personName = $personName;
        $contact->communicationChannelCode = array();
        return $contact;
    }
    /**
     * @param string $contactTypeCode
     */
    public function setContactTypeCode($contactTypeCode)
    {
        $this->contactTypeCode = $contactTypeCode;
    }

    /**
     * @return string
     */
    public function getContactTypeCode()
    {
        return $this->contactTypeCode;
    }

    /**
     * @param string $personName
     */
    public function setPersonName($personName)
    {
        $this->personName = $personName;
    }

    /**
     * @return string
     */
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Contact[] $communicationChannelCode
     */
    public function setCommunicationChannelCode(array $communicationChannelCode)
    {
        $this->communicationChannelCode = $communicationChannelCode;
    }

    /**
     * @return Contact[]
     */
    public function getCommunicationChannelCode()
    {
        if ($this->communicationChannelCode == null) {
            $this->communicationChannelCode = array();
        }
        return $this->communicationChannelCode;
    }

    public function addContact($type, $value) {
        if ($this->communicationChannelCode == null) {
            $this->communicationChannelCode = array();
        }
        array_push($this->communicationChannelCode, Contact::create($type, $value));
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