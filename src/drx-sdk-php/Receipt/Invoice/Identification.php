<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Invoice;
require_once __DIR__."/../../Utils/Utils.php";

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
        return \Utils::removeNullProperties($ret);
    }
}