<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-25
 * Time: 06:58
 */

class ObjectComparator
{
    const INVALID = "invalid";

    public static function compare($first, $second, $path = "ROOT") {
        if (!is_object($first) && !is_object($second) && !is_array($first) && !is_array($second)) {
            if (strval($first) != strval($second)) {
                // Check for booleans
                if (ObjectComparator::isBool($first) && ObjectComparator::isBool($second) && ObjectComparator::boolValue($first) == ObjectComparator::boolValue($second)) {
                    return true;
                }
                print ("Values don't match first object has ".$first.", second object has ".$second." as ".$path."\n");
                return false;
            }
            return true;
        }
        else if (is_array($first) && is_array($second)) {
            if (count($first) != count($second)) {
                print ("Array length don't match first object has ".count($first)." items, second object has ".count($second)." items at ".$path."\n");
                return false;
            }
            for ($i = 0; $i < count($first); $i++) {
                if (!ObjectComparator::compare($first[$i], $second[$i], $path."[".$i."]")) {
                    return false;
                }
            }
            return true;
        }
        else if (is_object($first) && is_object($second)){
            $firstArr = get_object_vars($first);
            $secondArr = get_object_vars($second);
            foreach ($firstArr as $key => $value) {
                if (!array_key_exists($key, $secondArr)) {
                    print ("Object fields don't match, ".$key." is missing from second object at ".$path."\n");
                    return false;
                }
                if (!ObjectComparator::compare($value, $secondArr[$key], $path.".".$key)) {
                    return false;
                }
            }
            foreach ($secondArr as $key => $value) {
                if (!array_key_exists($key, $firstArr)) {
                    print ("Object fields doesn't match, ".$key." is missing from first object at ".$path."\n");
                    return false;
                }
            }
            return true;
        }
        else {
            print ("Value types don't match first is ".gettype($first)." second is ".gettype($second)." at ".$path."\n");
            return false;
        }
    }

    public static function isBool($value){
        return (ObjectComparator::boolValue($value) != ObjectComparator::INVALID);
    }

    public static function boolValue($value) {
        if (($value == "true") || ($value == 1) || ($value == true)) {
            return "true";
        }
        else if (($value == "false") || ($value == 0) || ($value == false)) {
            return "false";
        } else {
            return ObjectComparator::INVALID;
        }
    }
}