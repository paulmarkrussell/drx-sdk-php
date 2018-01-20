<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-15
 * Time: 07:48
 */

namespace Dreceiptx\Receipt\Tax;
require_once __DIR__."/../../Utils/Utils.php";

class Tax implements \JsonSerializable
{
    public function jsonSerialize()
    {
        $ret = new \stdClass();
        return \Utils::removeNullProperties($ret);
    }
}