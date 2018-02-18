<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 16:07
 */

class Utils
{
    public static function removeNullProperties($obj)
    {
        $ret = new \stdClass();
        foreach ($obj as $property => $value) {
            if ($value !== null) {
                $ret->$property = $value;
            }
        }
        return $ret;
    }

    public static function deleteDir($dirPath)
    {
        if (!file_exists($dirPath)) {
            return;
        }
        $it = new RecursiveDirectoryIterator($dirPath, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
            RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
        rmdir($dirPath);
    }
}