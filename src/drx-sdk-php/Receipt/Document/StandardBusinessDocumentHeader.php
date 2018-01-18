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
     * @param DocumentOwner[] $receiver
     */
    public function setReceiver(array $receiver)
    {
        $this->receiver = $receiver;
    }

    /**
     * @param DocumentIdentification $documentIdentification
     */
    public function setDocumentIdentification($documentIdentification)
    {
        $this->documentIdentification = $documentIdentification;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->sender = $this->sender;
        $ret->receiver = $this->receiver;
        $ret->documentIdentification = $this->documentIdentification;
        return $ret;
    }
}