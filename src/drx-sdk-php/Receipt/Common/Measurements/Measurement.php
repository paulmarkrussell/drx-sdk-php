<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common\Measurements;

require_once __DIR__."/../../../Utils/Utils.php";

class Measurement implements \JsonSerializable
{

    private $measurementUnitCode;
    private $vale;

    /**
     * @param string $measurementUnitCode
     */
    public function setMeasurementUnitCode($measurementUnitCode)
    {
        $this->measurementUnitCode = $measurementUnitCode;
    }

    /**
     * @param double $vale
     */
    public function setVale($vale)
    {
        $this->vale = $vale;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->measurementUnitCode = $this->measurementUnitCode;
        $ret->vale = $this->vale;
        return \Utils::removeNullProperties($ret);
    }
}