<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
use Dreceiptx\Receipt\Common\SellerInformation;

require_once __DIR__ . "/../../Utils/Utils.php";

class SettlementParty implements \JsonSerializable
{

    private $partyRoleCode;
    private $value;

    /**
     * @param string $code
     * @param string $value
     * @return SettlementParty
     */
    public static function create($code, $value) {
        $party = new SettlementParty();
        $party->partyRoleCode = $code;
        $party->value = $value;
        return $party;
    }

    /**
     * @param string $partyRoleCode
     */
    public function setPartyRoleCode($partyRoleCode)
    {
        $this->partyRoleCode = $partyRoleCode;
    }

    /**
     * @return string
     */
    public function getPartyRoleCode()
    {
        return $this->partyRoleCode;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->partyRoleCode = $this->partyRoleCode;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}