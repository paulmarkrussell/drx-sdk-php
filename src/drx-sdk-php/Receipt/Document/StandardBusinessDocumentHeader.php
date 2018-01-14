<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 15:37
 */

namespace Dreceiptx\Receipt\Document;

class StandardBusinessDocumentHeader implements \JsonSerializable
{
    private $sender;
    private $receiver;

    public function setSender($sender)
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