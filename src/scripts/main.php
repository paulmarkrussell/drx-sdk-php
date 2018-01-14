<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:29
 */
require_once ("../drx-sdk-php/Receipt/DigitalReceipt.php");
if (count($argv) == 1) {
    print "File path of json to parse required.";
    return;
} elseif (count($argv) > 2) {
    print "Only a single parameter supported.";
    return;
}
print "Parsing file ".$argv[1]."\n";
$json = file_get_contents($argv[1]);
$receipt = \Dreceiptx\Receipt\DigitalReceipt::fromJson($json);
print $receipt->toJson();