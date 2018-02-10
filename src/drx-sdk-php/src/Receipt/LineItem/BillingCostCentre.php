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

    public static function create($id) {
        $centre = new BillingCostCentre();
        $centre->entityIdentification = $id;
        return $centre;
    }
    /**
     * @param string $entityIdentification
     */
    public function setEntityIdentification($entityIdentification)
    {
        $this->entityIdentification = $entityIdentification;
    }

    /**
     * @return string
     */
    public function getEntityIdentification()
    {
        return $this->entityIdentification;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->entityIdentification = $this->entityIdentification;
        return \Utils::removeNullProperties($ret);
    }
}