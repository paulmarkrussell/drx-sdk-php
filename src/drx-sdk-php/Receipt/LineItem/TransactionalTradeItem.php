<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-20
 * Time: 07:51
 */

namespace Dreceiptx\Receipt\LineItem;

require_once __DIR__."/TradeItemDescriptionInformation.php";
require_once __DIR__."/TradeItemIdentification.php";
require_once __DIR__."/TransactionaltemData.php";
require_once __DIR__."/../Common/Measurements/TradeItemMeasurements.php";
require_once __DIR__."/../../Utils/Utils.php";

class TransactionalTradeItem implements \JsonSerializable
{

    private $tradeItemDescriptionInformation;
    private $transactionItemData;
    private $additionalTradeItemIdentification;
    private $tradeItemMeasurements;

    /**
     * @param TradeItemDescriptionInformation $tradeItemDescriptionInformation
     */
    public function setTradeItemDescriptionInformation($tradeItemDescriptionInformation)
    {
        $this->tradeItemDescriptionInformation = $tradeItemDescriptionInformation;
    }

    /**
     * @return TradeItemDescriptionInformation
     */
    public function getTradeItemDescriptionInformation()
    {
        return $this->tradeItemDescriptionInformation;
    }

    /**
     * @param TransactionaltemData $transactionItemData
     */
    public function setTransactionItemData($transactionItemData)
    {
        $this->transactionItemData = $transactionItemData;
    }

    /**
     * @return TransactionaltemData
     */
    public function getTransactionItemData()
    {
        return $this->transactionItemData;
    }

    /**
     * @param TradeItemIdentification[] $additionalTradeItemIdentification
     */
    public function setAdditionalTradeItemIdentification(array $additionalTradeItemIdentification)
    {
        $this->additionalTradeItemIdentification = $additionalTradeItemIdentification;
    }

    /**
     * @return TradeItemIdentification[]
     */
    public function getAdditionalTradeItemIdentification()
    {
        return $this->additionalTradeItemIdentification;
    }

    /**
     * @param \Dreceiptx\Receipt\Common\Measurements\TradeItemMeasurements $tradeItemMeasurements
     */
    public function setTradeItemMeasurements($tradeItemMeasurements)
    {
        $this->tradeItemMeasurements = $tradeItemMeasurements;
    }

    /**
     * @return \Dreceiptx\Receipt\Common\Measurements\TradeItemMeasurements
     */
    public function getTradeItemMeasurements()
    {
        return $this->tradeItemMeasurements;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->tradeItemDescriptionInformation = $this->tradeItemDescriptionInformation;
        $ret->transactionItemData = $this->transactionItemData;
        $ret->additionalTradeItemIdentification = $this->additionalTradeItemIdentification;
        $ret-> tradeItemMeasurements= $this->tradeItemMeasurements;

        return \Utils::removeNullProperties($ret);
    }
}