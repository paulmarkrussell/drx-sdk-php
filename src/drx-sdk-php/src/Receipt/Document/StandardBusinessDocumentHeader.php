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
    /** @var DocumentOwner[] $sender */
    private $sender;
    /** @var DocumentOwner[] $receiver */
    private $receiver;
    /** @var DocumentIdentification $documentIdentification */
    private $documentIdentification;

    /**
     * @return StandardBusinessDocumentHeader
     */
    public static function create() {
        $header = new StandardBusinessDocumentHeader();

        $merchant = new DocumentOwner();
        $merchantIdentifier = DocumentOwnerIdentification::create("GS1", null);
        $merchant->setIdentifier($merchantIdentifier);
        $header->addSender($merchant);

        $dRx = new DocumentOwner();
        $dRxIdentifier = DocumentOwnerIdentification::create("GS1", null);
        $dRx->setIdentifier($dRxIdentifier);
        $header->addReceiver($dRx);

        $user = new DocumentOwner();
        $userIdentifier = DocumentOwnerIdentification::create("dRx", null);
        $user->setIdentifier($userIdentifier);
        $header->addReceiver($user);

        return $header;
    }

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

    public function addSender($sender) {
        if($this->sender == null) {
            $this->sender = array();
        }
        array_push($this->sender, $sender);
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

    public function addReceiver($receiver) {
        if($this->receiver == null) {
            $this->receiver = array();
        }
        array_push($this->receiver, $receiver);
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

    public function setMerchantGLN($merchantGLN) {
        $this->sender[0]->getIdentifier()->setValue($merchantGLN);
    }

    public function getMerchantGLN() {
        return $this->sender[0]->getIdentifier()->getValue();
    }

   public function setdRxGLN($dRxGLN) {
        $this->receiver[0]->getIdentifier()->setValue($dRxGLN);
    }

    public function getdRxGLN() {
        return $this->receiver[0]->getIdentifier()->getValue();
    }

    public function setUserIdentifier($userIdentifier) {
        $this->receiver[1]->getIdentifier()->setValue($userIdentifier);
    }

    public function getUserIdentifier() {
        return $this->receiver[1]->getIdentifier()->getValue();
    }

    public function addMerchantContact($contact) {
        $this->sender[0]->addContactinformation($contact);
    }

    public function addRMSContact($contact) {
        $this->receiver[1]->addContactinformation($contact);
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