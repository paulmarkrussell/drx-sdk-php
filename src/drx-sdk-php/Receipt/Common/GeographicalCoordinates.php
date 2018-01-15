<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;

class GeographicalCoordinates implements \JsonSerializable
{
    private $latitude;
    private $longitude;

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->latitude = $this->latitude;
        $ret->longitude = $this->longitude;
        return $ret;
    }
}