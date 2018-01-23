<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__ . "/../../Utils/Utils.php";

class PaymentMethod implements \JsonSerializable
{

    public $paymentMethodCode;

    /**
     * @param string $paymentMethodCode
     */
    public function setPaymentMethodCode($paymentMethodCode)
    {
        $this->paymentMethodCode = $paymentMethodCode;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->paymentMethodCode = $this->paymentMethodCode;
        return \Utils::removeNullProperties($ret);
    }
}