<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-23
 * Time: 06:00
 */

namespace Dreceiptx\Receipt\LineItem;


class BillingCostCentre implements \JsonSerializable
{

    private $entityIdentification;

    /**
     * @param mixed $entityIdentification
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