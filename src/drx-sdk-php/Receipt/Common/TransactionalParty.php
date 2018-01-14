<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:51
 */

namespace Dreceiptx\Receipt\Common;

class TransactionalParty implements \JsonSerializable
{
    public function jsonSerialize()
    {
        $ret = new \stdClass();
        return $ret;
    }
}