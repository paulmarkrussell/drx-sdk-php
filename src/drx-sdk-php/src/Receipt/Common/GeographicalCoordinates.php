<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/../../Utils/Utils.php";

class GeographicalCoordinates implements \JsonSerializable
{
    private $latitude;
    private $longitude;

    /**
     * @param string $latitude
     * @param string $longitude
     * @return GeographicalCoordinates
     */
    public static function create($latitude, $longitude) {
        $coords = new GeographicalCoordinates();
        $coords->latitude = $latitude;
        $coords->longitude = $longitude;
        return $coords;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->latitude = $this->latitude;
        $ret->longitude = $this->longitude;
        return \Utils::removeNullProperties($ret);
    }
}