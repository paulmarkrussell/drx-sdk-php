<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:16
 */

namespace Dreceiptx\Receipt;

require_once __DIR__.'/../vendor/autoload.php';

class DigitalReceipt
{
    public static function fromJson($json)
    {
        $mapper = new \JsonMapper();
        $receipt = $mapper->map($json, new DigitalReceipt());
        return $receipt;
    }

    public function toJson()
    {
        return json_encode($this);
    }
}