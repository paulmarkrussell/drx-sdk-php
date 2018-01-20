<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__."/../../Utils/Utils.php";

class PaymentReceipt implements \JsonSerializable
{
    public function jsonSerialize()
    {
        $ret = new \stdClass();
        return \Utils::removeNullProperties($ret);
    }
}