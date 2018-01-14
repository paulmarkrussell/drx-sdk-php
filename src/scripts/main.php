<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:29
 */
require_once ("../drx-sdk-php/Receipt/DigitalReceipt.php");
$receipt = \Dreceiptx\Receipt\DigitalReceipt::fromJson("");
print $receipt->toJson();