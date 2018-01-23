<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__ . "/../../Utils/Utils.php";

class SettlementParty implements \JsonSerializable
{

    private $partyRoleCode;
    private $value;

    /**
     * @param string $partyRoleCode
     */
    public function setPartyRoleCode($partyRoleCode)
    {
        $this->partyRoleCode = $partyRoleCode;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->partyRoleCode = $this->partyRoleCode;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}