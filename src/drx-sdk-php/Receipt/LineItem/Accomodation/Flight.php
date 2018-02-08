<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 07:04
 */

namespace Dreceiptx\Receipt\LineItem\Accomodation;

use Dreceiptx\Receipt\Ecom\AVPType;

require_once __DIR__."/../LineItem.php";
require_once __DIR__."/../TransactionalTradeItem.php";
require_once __DIR__."/../TradeItemDescriptionInformation.php";
require_once __DIR__."/../TradeItemIdentification.php";
require_once __DIR__."/../../Ecom/AVPType.php";

class Flight extends \Dreceiptx\Receipt\LineItem\LineItem
{
    const LINE_ITEM_TYPE_VALUE = "TRAVEL0002";

    public static function create($flightType, $airline, $shortItinerary, $longItinerary, $quantity, $price) {

        $tradeItemDescription = new \Dreceiptx\Receipt\LineItem\TradeItemDescriptionInformation();
        $tradeItemDescription->setBrandName($airline);
        $tradeItemDescription->setDescriptionShort($shortItinerary);
        $tradeItemDescription->setTradeItemDescription($longItinerary);
        $tradeItemDescription->setTradeItemGroupIdentificationCode($flightType);

        return self::createFromTradeItemDescriptionInformation($tradeItemDescription, $quantity, $price);
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

    public function getAirlineName() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getBrandName();
    }

    public function getItinerary() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getDescriptionShort();
    }

    public function getItineraryDescription() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getTradeItemDescription();
    }

    public function getFlightType() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getTradeItemGroupIdentificationCode();
    }

    public function setPassengerName($passengerName) {
        $this->setValue(\Dreceiptx\Receipt\Ecom\AVPType::PASSENGER_NAME, $passengerName);
    }

    public function getPassengerName() {
        return $this->getValue(\Dreceiptx\Receipt\Ecom\AVPType::PASSENGER_NAME);
    }

    public function setPassengerNameRecord($passengerNameRecord) {
        $this->setValue(\Dreceiptx\Receipt\Ecom\AVPType::PASSENGER_NAME_RECORD, $passengerNameRecord);
    }

    public function getPassengerNameRecord() {
        return $this->getValue(\Dreceiptx\Receipt\Ecom\AVPType::PASSENGER_NAME_RECORD);
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

    public function setTicketNumber($number) {
        $this->setSerialNumber($number);
    }

    public function getTicketNumber() {
        return $this->getSerialNumber();
    }

    public function setFlightDestination($flightDestination) {
        $this->setValue(AVPType::FLIGHT_DESTINATION_TYPE, $flightDestination);
    }

    public function getFlightDestination() {
        return $this->getValue(AVPType::FLIGHT_DESTINATION_TYPE);
    }
}