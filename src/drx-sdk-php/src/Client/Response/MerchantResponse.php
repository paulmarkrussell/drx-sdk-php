<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 21:07
 */

namespace Dreceiptx\Client\Response;

require_once __DIR__."/MerchantAddress.php";

use Dreceiptx\Receipt\Merchant\MerchantAddress;

class MerchantResponse
{

    private $httpCode;

    private $exceptionMessage;

    /**
     * @param mixed $httpCode
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param mixed $errorMessagte
     */
    public function setExceptionMessage($errorMessagte)
    {
        $this->errorMessagte = $errorMessagte;
    }

    /**
     * @return mixed
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
    }

    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $fullName
     */
    private $fullName;

    /**
     * @var string $commonName
     */
    private $commonName;

    /**
     * @var string $businessTaxNumber
     */
    private $businessTaxNumber;

    /**
     * @var string $businessTaxNumberType
     */
    private $businessTaxNumberType;

    /**
     * @var string $businessRegistrationNumber
     */
    private $businessRegistrationNumber;

    /**
     * @var string $primaryPhone
     */
    private $primaryPhone;

    /**
     * @var string $primaryEmail
     */
    private $primaryEmail;

    /**
     * @var string $website
     */
    private $website;
    /**
     * @var MerchantAddress $primaryAddress
     */
    private $primaryAddress;
    /**
     * @var string $sector
     */
    private $sector;
    /**
     * @var string $industry
     */
    private $industry;
    /**
     * @var string $status
     */
    private $status;

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
        return $this->primaryAddress;
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
}