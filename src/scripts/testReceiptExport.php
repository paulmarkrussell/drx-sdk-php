<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:29
 */
require_once (__DIR__."/../drx-sdk-php/Receipt/DigitalReceiptContainer.php");
require_once (__DIR__ . "/../drx-sdk-php/Utils/ObjectComparator.php");

if (count($argv) == 1) {
    print "File path of json to parse required.";
    return;
} elseif (count($argv) > 2) {
    print "Only a single parameter supported.";
    return;
}
print "Parsing file ".$argv[1]."\n";
$text = file_get_contents($argv[1]);
$json = json_decode($text);
$receipt = \Dreceiptx\Receipt\DigitalReceiptContainer::fromJson($json)->jsonSerialize();
;
if (ObjectComparator::compare($json, json_decode(json_encode($receipt)))) {
    print ("MATCH! :)) ");
} else {
    print ("Doesn't match :(");
}