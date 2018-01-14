<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 16:05
 */

namespace Dreceiptx\Receipt\Document;

class DocumentOwner implements \JsonSerializable
{

    public function jsonSerialize()
    {
        $ret = new stdClass();
        return $ret;
    }
}