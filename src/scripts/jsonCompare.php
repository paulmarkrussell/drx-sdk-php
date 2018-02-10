<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:29
 */
require_once (__DIR__ . "/../drx-sdk-php/Utils/ObjectComparator.php");

if (count($argv) == 2) {
    print "File path of the two jsons to compare required.";
    return;
} elseif (count($argv) > 3) {
    print "Only two parameters supported.";
    return;
}
$text1 = file_get_contents($argv[1]);
$json1 = json_decode($text1);
$text2 = file_get_contents($argv[2]);
$json2 = json_decode($text2);
if (ObjectComparator::compare($json1, $json2)) {
    print ("MATCH! :)) ");
} else {
    print ("Doesn't match :(");
}