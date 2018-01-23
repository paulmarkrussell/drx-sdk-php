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

    private $Authority;
    private $value;

    /**
     * @param string $Authority
     */
    public function setAuthority($Authority)
    {
        $this->Authority = $Authority;
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
        $ret->Authority = $this->Authority;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}