<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;

require_once __DIR__."/GeographicalCoordinates.php";
require_once __DIR__."/../../Utils/Utils.php";

class Address implements \JsonSerializable
{

    private $name;
    private $streetAddress1;
    private $streetAddress2;
    private $streetAddress3;
    private $city;
    private $postalCode;
    private $state;
    private $countryCode;
    private $geographicalCoordinates;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $streetAddress1
     */
    public function setStreetAddress1($streetAddress1)
    {
        $this->streetAddress1 = $streetAddress1;
    }

    /**
     * @return string
     */
    public function getStreetAddress1()
    {
        return $this->streetAddress1;
    }

    /**
     * @param string $streetAddress2
     */
    public function setStreetAddress2($streetAddress2)
    {
        $this->streetAddress2 = $streetAddress2;
    }

    /**
     * @return string
     */
    public function getStreetAddress2()
    {
        return $this->streetAddress2;
    }

    /**
     * @param string $streetAddress3
     */
    public function setStreetAddress3($streetAddress3)
    {
        $this->streetAddress3 = $streetAddress3;
    }

    /**
     * @return string
     */
    public function getStreetAddress3()
    {
        return $this->streetAddress3;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\GeographicalCoordinates $geographicalCoordinates
     */
    public function setGeographicalCoordinates($geographicalCoordinates)
    {
        $this->geographicalCoordinates = $geographicalCoordinates;
    }

    /**
     * @return \Dreceiptx\Receipt\Common\GeographicalCoordinates
     */
    public function getGeographicalCoordinates()
    {
        return $this->geographicalCoordinates;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->name = $this->name;
        $ret->streetAddress1 = $this->streetAddress1;
        $ret->streetAddress2 = $this->streetAddress2;
        $ret->streetAddress3 = $this->streetAddress3;
        $ret->city = $this->city;
        $ret->postalCode = $this->postalCode;
        $ret->state = $this->state;
        $ret->countryCode = $this->countryCode;
        $ret->geographicalCoordinates = $this->geographicalCoordinates;
        return \Utils::removeNullProperties($ret);
    }
}