<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Invoice;

class Identification implements \JsonSerializable
{
    public function jsonSerialize()
    {
        $ret = new \stdClass();
        return $ret;
    }
}