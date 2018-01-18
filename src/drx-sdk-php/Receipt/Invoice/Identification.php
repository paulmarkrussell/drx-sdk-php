<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Invoice;

class Identification implements \JsonSerializable
{

    private $entityIdentification;

    /**
     * @param string $entityIdentification
     */
    public function setEntityIdentification($entityIdentification)
    {
        $this->entityIdentification = $entityIdentification;
    }


    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->entityIdentification = $this->entityIdentification;
        return $ret;
    }
}