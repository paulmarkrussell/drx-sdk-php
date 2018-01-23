<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__ . "/../../Utils/Utils.php";

class Payee implements \JsonSerializable
{
    private $gln;

    /**
     * @param string $gln
     */
    public function setGln($gln)
    {
        $this->gln = $gln;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->gln = $this->gln;
        return \Utils::removeNullProperties($ret);
    }
}