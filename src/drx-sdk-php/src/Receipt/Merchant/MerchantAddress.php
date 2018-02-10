<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 06:12
 */

namespace Dreceiptx\Receipt\Merchant;

require_once __DIR__."/../../Utils/Utils.php";
require_once __DIR__."/MerchantAddress.php";

class MerchantAddress implements \JsonSerializable
{

    private $buildingnumber;
    private $streetnumber;
    private $street;
    private $street1;
    private $street2;
    private $street3;
    private $city;
    private $state;
    private $postcode;
    private $country;

    /**
     * @param string $buildingnumber
     */
    public function setBuildingnumber($buildingnumber)
    {
        $this->buildingnumber = $buildingnumber;
    }

    /**
     * @return string
     */
    public function getBuildingnumber()
    {
        return $this->buildingnumber;
    }

    /**
     * @param string $streetnumber
     */
    public function setStreetnumber($streetnumber)
    {
        $this->streetnumber = $streetnumber;
    }

    /**
     * @return string
     */
    public function getStreetnumber()
    {
        return $this->streetnumber;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street1
     */
    public function setStreet1($street1)
    {
        $this->street1 = $street1;
    }

    /**
     * @return string
     */
    public function getStreet1()
    {
        return $this->street1;
    }

    /**
     * @param string $street2
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
    }

    /**
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }

    /**
     * @param string $street3
     */
    public function setStreet3($street3)
    {
        $this->street3 = $street3;
    }

    /**
     * @return string
     */
    public function getStreet3()
    {
        return $this->street3;
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
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

   public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->buildingnumber = $this->buildingnumber;
        $ret->streetnumber = $this->streetnumber;
        $ret->street = $this->street;
        $ret->street1 = $this->street1;
        $ret->street2 = $this->street2;
        $ret->street3 = $this->street3;
        $ret->city = $this->city;
        $ret->state = $this->state;
        $ret->postcode = $this->postcode;
        $ret->country = $this->country;
        return \Utils::removeNullProperties($ret);
    }
}