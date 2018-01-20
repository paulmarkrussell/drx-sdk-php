<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/../../Utils/Utils.php";

class DespatchInformation implements \JsonSerializable
{
    private $estimatedDeliveryDateTime;
    private $despatchDateTime;
    private $deliveryInstructions;

    /**
     * @param \DateTime $estimatedDeliveryDateTime
     */
    public function setEstimatedDeliveryDateTime($estimatedDeliveryDateTime)
    {
        $this->estimatedDeliveryDateTime = $estimatedDeliveryDateTime;
    }

    /**
     * @param \DateTime $despatchDateTime
     */
    public function setDespatchDateTime($despatchDateTime)
    {
        $this->despatchDateTime = $despatchDateTime;
    }

    /**
     * @param string $deliveryInstructions
     */
    public function setDeliveryInstructions($deliveryInstructions)
    {
        $this->deliveryInstructions = $deliveryInstructions;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->estimatedDeliveryDateTime = $this->estimatedDeliveryDateTime;
        $ret->despatchDateTime = $this->despatchDateTime;
        $ret->deliveryInstructions = $this->deliveryInstructions;
        return \Utils::removeNullProperties($ret);
    }
}