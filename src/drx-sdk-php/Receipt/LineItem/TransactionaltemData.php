<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 07:51
 */

namespace Dreceiptx\Receipt\LineItem;
require_once __DIR__."/../../Utils/Utils.php";

class TransactionaltemData implements \JsonSerializable
{

    private $serialNumber;
    private $batchNumber;

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->serialNumber;
    }

    /**
     * @param string $batchNumber
     */
    public function setBatchNumber($batchNumber)
    {
        $this->batchNumber = $batchNumber;
    }

    /**
     * @return string
     */
    public function getBatchNumber()
    {
        return $this->batchNumber;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->serialNumber = $this->serialNumber;
        $ret->batchNumber = $this->batchNumber;
        return \Utils::removeNullProperties($ret);
    }
}