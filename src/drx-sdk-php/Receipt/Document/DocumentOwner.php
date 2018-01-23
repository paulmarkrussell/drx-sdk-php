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
     * @param ReceiptContact[] $contactInformation
     */
    public function setContactInformation(array $contactInformation)
    {
        $this->contactInformation = $contactInformation;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->identifier = $this->identifier;
        $ret->contactInformation = $this->contactInformation;
        return \Utils::removeNullProperties($ret);
    }
}