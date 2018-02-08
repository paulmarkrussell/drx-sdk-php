<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__ . "/../../Utils/Utils.php";

class PartyIdentification implements \JsonSerializable
{

    private $authority;
    private $value;

    /**
     * @param string $authority
     * @param string $value
     * @return PartyIdentification
     */
    public static function create($authority, $value) {
        $id = new PartyIdentification();
        $id->authority = $authority;
        $id->value = $value;
        return $id;
    }

    /**
     * @param string $authority
     */
    public function setAuthority($authority)
    {
        $this->authority = $authority;
    }

    /**
     * @return string
     */
    public function getAuthority()
    {
        return $this->authority;
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
        $ret->authority = $this->authority;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}