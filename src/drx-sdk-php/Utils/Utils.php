<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 16:07
 */

class Utils
{
    public static function removeNullProperties($obj){
        $ret = new \stdClass();
        foreach($obj as $property => $value)  {
            if ($value !== null) {
                $ret->$property = $value;
            }
        }
        return $ret;
    }
}