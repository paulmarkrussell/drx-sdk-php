<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 06:12
 */

namespace Dreceiptx\Receipt\Merchant;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__."/../../Utils/Utils.php";
require_once __DIR__."/MerchantAddress.php";

class Merchant implements \JsonSerializable
{
    private $industry;
    private $sector;
    private $id;
    private $fullName;
    private $commonName;
    private $businessTaxNumber;
    private $businessTaxNumberType;
    private $businessRegistrationNumber;
    private $primaryPhone;
    private $primaryAddress;
    private $primaryEmail;
    private $website;
    private $contacts;
    private $status;

    /**
     * @param string $industry
     */
    public function setIndustry($industry)
    {
        $this->industry = $industry;
    }

    /**
     * @return string
     */
    public function getIndustry()
    {
        return $this->industry;
    }

    /**
     * @param string $sector
     */
    public function setSector($sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $commonName
     */
    public function setCommonName($commonName)
    {
        $this->commonName = $commonName;
    }

    /**
     * @return string
     */
    public function getCommonName()
    {
        return $this->commonName;
    }

    /**
     * @param string $businessTaxNumber
     */
    public function setBusinessTaxNumber($businessTaxNumber)
    {
        $this->businessTaxNumber = $businessTaxNumber;
    }

    /**
     * @return string
     */
    public function getBusinessTaxNumber()
    {
        return $this->businessTaxNumber;
    }

    /**
     * @param string $businessTaxNumberType
     */
    public function setBusinessTaxNumberType($businessTaxNumberType)
    {
        $this->businessTaxNumberType = $businessTaxNumberType;
    }

    /**
     * @return string
     */
    public function getBusinessTaxNumberType()
    {
        return $this->businessTaxNumberType;
    }

    /**
     * @param string $businessRegistrationNumber
     */
    public function setBusinessRegistrationNumber($businessRegistrationNumber)
    {
        $this->businessRegistrationNumber = $businessRegistrationNumber;
    }

    /**
     * @return string
     */
    public function getBusinessRegistrationNumber()
    {
        return $this->businessRegistrationNumber;
    }

    /**
     * @param string $primaryPhone
     */
    public function setPrimaryPhone($primaryPhone)
    {
        $this->primaryPhone = $primaryPhone;
    }

    /**
     * @return string
     */
    public function getPrimaryPhone()
    {
        return $this->primaryPhone;
    }

    /**
     * @param MerchantAddress $primaryAddress
     */
    public function setPrimaryAddress($primaryAddress)
    {
        $this->primaryAddress = $primaryAddress;
    }

    /**
     * @return MerchantAddress
     */
    public function getPrimaryAddress()
    {
        if($this->primaryAddress == null) {
            $this->primaryAddress = new MerchantAddress();
        }
        return $this->primaryAddress;
    }

    /**
     * @param string $primaryEmail
     */
    public function setPrimaryEmail($primaryEmail)
    {
        $this->primaryEmail = $primaryEmail;
    }

    /**
     * @return string
     */
    public function getPrimaryEmail()
    {
        return $this->primaryEmail;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param MerchantAddress[] $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return MerchantAddress[]
     */
    public function getContacts()
    {
        if ($this->contacts == null) {
            $this->contacts = array();
        }
        return $this->contacts;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param $json S row object containing merchant data
     * @return Merchant
     * @throws \JsonMapper_Exception
     */
    public static function fromJson($json)
    {
        $mapper = new \JsonMapper();
        $merchant = $mapper->map($json, new Merchant());
        return $merchant;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->industry = $this->industry;
        $ret->sector = $this->sector;
        $ret->id = $this->id;
        $ret->fullName = $this->fullName;
        $ret->commonName = $this->commonName;
        $ret->businessTaxNumber = $this->businessTaxNumber;
        $ret->businessTaxNumberType = $this->businessTaxNumberType;
        $ret->businessRegistrationNumber = $this->businessRegistrationNumber;
        $ret->primaryPhone = $this->primaryPhone;
        $ret->primaryAddress = $this->primaryAddress;
        $ret->primaryEmail = $this->primaryEmail;
        $ret->website = $this->website;
        $ret->contacts = $this->contacts;
        $ret->status = $this->status;
        return \Utils::removeNullProperties($ret);
    }
}