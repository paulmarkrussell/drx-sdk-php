<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 15:37
 */

namespace Dreceiptx\Receipt\Document;
use Couchbase\DocIdSearchQuery;
use Dreceiptx\Receipt\Merchant\MerchantAddress;

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
    public static function create($sender, $receiver1, $receiver2) {
        $header = new StandardBusinessDocumentHeader();

        $merchant = new DocumentOwner();
        $merchantIdentifier = DocumentOwnerIdentification::create("GS1", $sender);
        $merchant->setIdentifier($merchantIdentifier);
        $header->addSender($merchant);

        $dRx = new DocumentOwner();
        $dRxIdentifier = DocumentOwnerIdentification::create("GS1", $receiver1);
        $dRx->setIdentifier($dRxIdentifier);
        $header->addReceiver($dRx);

        $user = new DocumentOwner();
        $userIdentifier = DocumentOwnerIdentification::create("dRx", $receiver2);
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
        $this->makeSureHasDocumentSender(1);
        $this->sender[0]->getIdentifierNotNull()->setValue($merchantGLN);
    }

    public function getMerchantGLN() {
        return $this->sender[0]->getIdentifierNotNull()->getValue();
    }

   public function setdRxGLN($dRxGLN) {
       $this->makeSureHasDocumentReceiver(1);
       $this->receiver[0]->getIdentifierNotNull()->setValue($dRxGLN);
    }

    public function getdRxGLN() {
        return $this->receiver[0]->getIdentifierNotNull()->getValue();
    }

    public function setUserIdentifier($userIdentifier) {
        $this->makeSureHasDocumentReceiver(2);
        $this->receiver[1]->getIdentifierNotNull()->setValue($userIdentifier);
    }

    public function getUserIdentifier() {
        return $this->receiver[1]->getIdentifierNotNull()->getValue();
    }

    /**
     * @param ReceiptContact $contact
     */
    public function addMerchantContact($contact) {
        $this->makeSureHasDocumentSender(1);
        $this->sender[0]->addContactinformation($contact);
    }

    public function addRMSContact($contact) {
        $this->makeSureHasDocumentReceiver(2);
        $this->receiver[1]->addContactinformation($contact);
    }

    public function setTypeVersion($typeVersion) {
        if ($this->documentIdentification == null) {
            $this->documentIdentification = new DocumentIdentification();
        }
        $this->documentIdentification->setTypeVersion($typeVersion);
    }

    /** @param \DateTime $dateTime */
    public function setCreationDateAndTime($dateTime) {
        if ($this->documentIdentification == null) {
            $this->documentIdentification = new DocumentIdentification();
        }
        $this->documentIdentification->setCreationDateAndTime($dateTime);
    }

    private function makeSureHasDocumentSender($cnt) {
        if($this->sender == null) {
            $this->sender = array();
        }
        while (count($this->sender) < $cnt) {
            array_push($this->sender, new DocumentOwner());
        }
    }

    private function makeSureHasDocumentReceiver($cnt) {
        if($this->receiver == null) {
            $this->receiver = array();
        }
        while (count($this->receiver) < $cnt) {
            array_push($this->receiver, new DocumentOwner());
        }
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