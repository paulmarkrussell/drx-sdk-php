<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 07:51
 */

namespace Dreceiptx\Receipt\LineItem;


class TransactionaltemData implements \JsonSerializable
{

    private $serialNumber;
    private $batchNumber;

    /**
     * @param mixed $serialNumber
     */
    public function setSerialNumber($serialNumber)
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @param mixed $batchNumber
     */
    public function setBatchNumber($batchNumber)
    {
        $this->batchNumber = $batchNumber;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->serialNumber = $this->serialNumber;
        $ret->batchNumber = $this->batchNumber;
        return $ret;
    }
}