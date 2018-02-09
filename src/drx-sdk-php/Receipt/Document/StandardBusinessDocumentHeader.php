<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 15:37
 */

namespace Dreceiptx\Receipt\Document;
require_once __DIR__."/DocumentOwner.php";
require_once __DIR__."/DocumentIdentification.php";
require_once __DIR__."/../../Utils/Utils.php";

class StandardBusinessDocumentHeader implements \JsonSerializable
{
    private $sender;
    private $receiver;
    private $documentIdentification;

    /**
     * @param DocumentOwner[] $sender
     */
    public function setSender(array $sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return DocumentOwner[]
     */
    public function getSender()
    {
        if($this->sender == null) {
            $this->sender = array();
        }
        return $this->sender;
    }

    /**
     * @param DocumentOwner[] $receiver
     */
    public function setReceiver(array $receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @return DocumentOwner[]
     */
    public function getReceiver()
    {
        if($this->receiver == null) {
            $this->receiver = array();
        }
        return $this->receiver;
    }

    /**
     * @param DocumentIdentification $documentIdentification
     */
    public function setDocumentIdentification($documentIdentification)
    {
        $this->documentIdentification = $documentIdentification;
    }

    /**
     * @return DocumentIdentification
     */
    public function getDocumentIdentification()
    {
        return $this->documentIdentification;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->sender = $this->sender;
        $ret->receiver = $this->receiver;
        $ret->documentIdentification = $this->documentIdentification;
        return \Utils::removeNullProperties($ret);
    }
}