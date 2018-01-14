<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 15:37
 */

namespace Dreceiptx\Receipt\Document;
require_once __DIR__."/DocumentOwner.php";

class StandardBusinessDocumentHeader implements \JsonSerializable
{
    private $sender;
    private $receiver;

    /**
     * @param DocumentOwner[] $sender
     */
    public function setSender(array $sender)
    {
        print "Setting sender";
        $this->sender = $sender;
    }

    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->sender = $this->sender;
        return $ret;
    }
}