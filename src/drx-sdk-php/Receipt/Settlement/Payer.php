<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__ . "/../../Utils/Utils.php";

class Payer implements \JsonSerializable
{

    private $gln;
    private $additionalPartyIdentification;

    /**
     * @param string $gln
     */
    public function setGln($gln)
    {
        $this->gln = $gln;
    }

    /**
     * @param PartyIdentification $additionalPartyIdentification
     */
    public function setAdditionalPartyIdentification($additionalPartyIdentification)
    {
        $this->additionalPartyIdentification = $additionalPartyIdentification;
    }


    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->gln = $this->gln;
        $ret->additionalPartyIdentification = $this->additionalPartyIdentification;
        return \Utils::removeNullProperties($ret);
    }
}