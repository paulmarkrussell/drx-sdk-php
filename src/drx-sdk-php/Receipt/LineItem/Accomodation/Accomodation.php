<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 07:04
 */

namespace Dreceiptx\Receipt\LineItem\Accomodation;

require_once __DIR__."/../LineItem.php";
require_once __DIR__."/../TransactionalTradeItem.php";
require_once __DIR__."/../TradeItemDescriptionInformation.php";
require_once __DIR__."/../TradeItemIdentification.php";
require_once __DIR__."/../../Ecom/AVPType.php";

class Accomodation extends \Dreceiptx\Receipt\LineItem\LineItem
{
    const LINE_ITEM_TYPE_VALUE = "TRAVEL0001";

    public static function create($accommodationType, $provider, $shortDescription, $longDescription, $nights, $rate) {

        $tradeItemDescription = new \Dreceiptx\Receipt\LineItem\TradeItemDescriptionInformation();
        $tradeItemDescription->setBrandName($provider);
        $tradeItemDescription->setDescriptionShort($shortDescription);
        $tradeItemDescription->setTradeItemDescription($longDescription);
        $tradeItemDescription->setTradeItemGroupIdentificationCode($accommodationType);

        return self::createFromTradeItemDescriptionInformation($tradeItemDescription, $nights, $rate);
    }

    public static function createFromTradeItemDescriptionInformation ($tradeItemDescriptionInformation, $quantity, $price) {
        $lineItem = new MaterialGeneric();
        $lineItem->setInvoicedQuantity($quantity);
        $lineItem->setItemPriceExclusiveAllowancesCharges($price);


        $tradeItem = new \Dreceiptx\Receipt\LineItem\TransactionalTradeItem();
        $tradeItem->setTradeItemDescriptionInformation($tradeItemDescriptionInformation);

        $tradeItemIdentification = new \Dreceiptx\Receipt\LineItem\TradeItemIdentification();

        $tradeItemIdentification->setAdditionalTradeItemIdentificationType(\Dreceiptx\Receipt\LineItem\LineItem::LINE_ITEM_TYPE_IDENTIFIER);
        $tradeItemIdentification->setAdditionalTradeItemIdentificationValue(Accomodation::LINE_ITEM_TYPE_VALUE);
        $tradeItem->setAdditionalTradeItemIdentification([

        ]);

        $lineItem->setTransactionalTradeItem($tradeItem);

        return $lineItem;
    }

    public function getProviderName() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getBrandName();
    }

    public function getShortDescription() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getDescriptionShort();
    }

    public function getProductDescription() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getTradeItemDescription();
    }

    public function getAccomodationType() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getTradeItemGroupIdentificationCode();
    }

    public function setPassengerName($passengerName) {
        $this->setValue(\Dreceiptx\Receipt\Ecom\AVPType::PASSENGER_NAME, $passengerName);
    }

    public function getPassengerName() {
        return $this->getValue(\Dreceiptx\Receipt\Ecom\AVPType::PASSENGER_NAME);
    }

    public function setDepartureDate($date) {
        $this->setDespatchDate($date);
    }

    public function getDepartureDate()
    {
        return $this->getDespatchDate();
    }

    public function setArrivalDate($date) {
        $this->setDeliveryDate($date);
    }

    public function getArrivalDate() {
        return $this->getDeliveryDate();
    }
}