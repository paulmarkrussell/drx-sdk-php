<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 07:51
 */

namespace Dreceiptx\Receipt\LineItem;
require_once __DIR__."/../../Utils/Utils.php";

class TradeItemDescriptionInformation implements \JsonSerializable
{

    private $brandName;
    private $descriptionShort;
    private $tradeItemDescription;
    private $isTradeItemAService;
    private $isTradeItemReconditioned;
    private $tradeItemGroupIdentificationCode ;
    private $gtin;

    /**
     * @param string $brandName
     */
    public function setBrandName($brandName)
    {
        $this->brandName = $brandName;
    }

    /**
     * @return string
     */
    public function getBrandName()
    {
        return $this->brandName;
    }

    /**
     * @param string $descriptionShort
     */
    public function setDescriptionShort($descriptionShort)
    {
        $this->descriptionShort = $descriptionShort;
    }

    /**
     * @return string
     */
    public function getDescriptionShort()
    {
        return $this->descriptionShort;
    }

    /**
     * @param string $tradeItemDescription
     */
    public function setTradeItemDescription($tradeItemDescription)
    {
        $this->tradeItemDescription = $tradeItemDescription;
    }

    /**
     * @return string
     */
    public function getTradeItemDescription()
    {
        return $this->tradeItemDescription;
    }

    /**
     * @param boolean $isTradeItemAService
     */
    public function setIsTradeItemAService($isTradeItemAService)
    {
        $this->isTradeItemAService = $isTradeItemAService;
    }

    /**
     * @return boolean
     */
    public function getisTradeItemAService()
    {
        return $this->isTradeItemAService;
    }

    /**
     * @param boolean $isTradeItemReconditioned
     */
    public function setIsTradeItemReconditioned($isTradeItemReconditioned)
    {
        $this->isTradeItemReconditioned = $isTradeItemReconditioned;
    }

    /**
     * @return boolean
     */
    public function getisTradeItemReconditioned()
    {
        return $this->isTradeItemReconditioned;
    }

    /**
     * @param string $tradeItemGroupIdentificationCode
     */
    public function setTradeItemGroupIdentificationCode($tradeItemGroupIdentificationCode)
    {
        $this->tradeItemGroupIdentificationCode = $tradeItemGroupIdentificationCode;
    }

    /**
     * @return string
     */
    public function getTradeItemGroupIdentificationCode()
    {
        return $this->tradeItemGroupIdentificationCode;
    }

    /**
     * @param string $gtin
     */
    public function setGtin($gtin)
    {
        $this->gtin = $gtin;
    }

    /**
     * @return string
     */
    public function getGtin()
    {
        return $this->gtin;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->brandName = $this->brandName;
        $ret->descriptionShort = $this->descriptionShort;
        $ret->tradeItemDescription = $this->tradeItemDescription;
        $ret->isTradeItemAService = $this->isTradeItemAService;
        $ret->isTradeItemReconditioned = $this->isTradeItemReconditioned;
        $ret->tradeItemGroupIdentificationCode  = $this->tradeItemGroupIdentificationCode;
        $ret->gtin = $this->gtin;
        return \Utils::removeNullProperties($ret);
    }
}