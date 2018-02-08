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

    public static function create($gln, $authority, $value) {
        $payer = new Payer();
        $payer->gln = $gln;
        $payer->additionalPartyIdentification = PartyIdentification::create($authority, $value);
        return $payer;
    }
    /**
     * @param string $gln
     */
    public function setGln($gln)
    {
        $this->gln = $gln;
    }

    /**
     * @return string
     */
    public function getGln()
    {
        return $this->gln;
    }

    /**
     * @param PartyIdentification $additionalPartyIdentification
     */
    public function setAdditionalPartyIdentification($additionalPartyIdentification)
    {
        $this->additionalPartyIdentification = $additionalPartyIdentification;
    }

    /**
     * @return PartyIdentification
     */
    public function getAdditionalPartyIdentification()
    {
        return $this->additionalPartyIdentification;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->gln = $this->gln;
        $ret->additionalPartyIdentification = $this->additionalPartyIdentification;
        return \Utils::removeNullProperties($ret);
    }
}