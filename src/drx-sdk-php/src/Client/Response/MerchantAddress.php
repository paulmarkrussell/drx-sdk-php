<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 21:07
 */

namespace Dreceiptx\Client\Response;

class MerchantAddress
{
    /**
     * @var string $buildingnumber
     */
    private $buildingnumber;

    /**
     * @var string $streetnumber
     */
    private $streetnumber;

    /**
     * @var string $street
     */
    private $street;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $state
     */
    private $state;

    /**
     * @var string $postcode
     */
    private $postcode;

    /**
     * @var string $country
     */
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
}