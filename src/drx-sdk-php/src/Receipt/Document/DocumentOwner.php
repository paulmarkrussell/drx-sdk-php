<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 16:05
 */

namespace Dreceiptx\Receipt\Document;
require_once __DIR__."/DocumentOwnerIdentification.php";
require_once __DIR__ . "/ReceiptContact.php";
require_once __DIR__."/../../Utils/Utils.php";

class DocumentOwner implements \JsonSerializable
{
    private $identifier;
    private $contactInformation;

    /**
     * @param DocumentOwnerIdentification $identifier
     */
    public function setIdentifier(DocumentOwnerIdentification $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return DocumentOwnerIdentification
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return DocumentOwnerIdentification
     */
    public function getIdentifierNotNull()
    {
        if($this->identifier == null) {
            $this->identifier = new DocumentOwnerIdentification();
        }
        return $this->identifier;
    }

    /**
     * @param ReceiptContact[] $contactInformation
     */
    public function setContactInformation(array $contactInformation)
    {
        $this->contactInformation = $contactInformation;
    }

    /**
     * @return ReceiptContact[]
     */
    public function getContactInformation()
    {
        if ($this->contactInformation == null) {
            $this->contactInformation = array();
        }
        return $this->contactInformation;
    }

    public function addContactinformation($contactInformation) {
        if ($this->contactInformation == null) {
            $this->contactInformation = array();
        }
        array_push($this->contactInformation, $contactInformation);
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->identifier = $this->identifier;
        $ret->contactInformation = $this->contactInformation;
        return \Utils::removeNullProperties($ret);
    }
}