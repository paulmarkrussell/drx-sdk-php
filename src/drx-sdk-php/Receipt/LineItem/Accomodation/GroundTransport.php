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

class GroundTransport extends \Dreceiptx\Receipt\LineItem\LineItem
{
    const LINE_ITEM_TYPE_VALUE = "TRAVEL0003";

    public static function create($transportType, $provider, $shortDescription, $longDescription, $quantity, $price) {

        $tradeItemDescription = new \Dreceiptx\Receipt\LineItem\TradeItemDescriptionInformation();
        $tradeItemDescription->setBrandName($provider);
        $tradeItemDescription->setDescriptionShort($shortDescription);
        $tradeItemDescription->setTradeItemDescription($longDescription);
        $tradeItemDescription->setTradeItemGroupIdentificationCode($transportType);

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

    public function getProvider() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getBrandName();
    }

    public function getShortDescription() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getDescriptionShort();
    }

    public function getLongDescription() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getTradeItemDescription();
    }

    public function getGroundTransportType() {
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

    public function setVehicleIndentifier($identifier) {
        $this->setValue(\Dreceiptx\Receipt\Ecom\AVPType::VEHICLE_IDENTIFIER, $identifier);
    }

    public function getVehicleIndentifier() {
        return $this->getValue(\Dreceiptx\Receipt\Ecom\AVPType::VEHICLE_IDENTIFIER);
    }

    public function setTripDistance($distance) {
        $this->setValue(\Dreceiptx\Receipt\Ecom\AVPType::TRIP_DISTANCE, $distance);
    }

    public function getTripDistance() {
        return $this->getValue(\Dreceiptx\Receipt\Ecom\AVPType::TRIP_DISTANCE);
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

    public function setBookingNumber($number) {
        $this->setSerialNumber($number);
    }

    public function getBookingNumber() {
        return $this->getSerialNumber();
    }

    public function setTipCode($code) {
        $this->getBillingCostCentre()->setEntityIdentification($code);
    }

    public function getTripCode() {
        return $this->getBillingCostCentre()->getEntityIdentification();
    }

    public function setTripReason($reason) {
        $this->setNote($reason);
    }

    public function getTripReason() {
        return $this->getNote();
    }

    public function setDepartureGeoLocation($location) {
        $this->getShipFrom()->getAddress()->setGeographicalCoordinates($location);
    }

    public function getDepartureGeoLocation() {
        $this->getShipFrom()->getAddress()->getGeographicalCoordinates();
    }

    public function setArrivalGeoLocation($location) {
        $this->getShipTo()->getAddress()->setGeographicalCoordinates($location);
    }

    public function getArrivalGeoLocation() {
        $this->getShipTo()->getAddress()->getGeographicalCoordinates();
    }

    public function SetDepartureDetails($departureDate, $departureCoordinates) {
        $this->setDepartureDate($departureDate);
        $this->setDepartureGeoLocation($departureCoordinates);
    }

    public function setArrivalDetails($arrivalDate, $arrivalCoordinates) {
        $this->setArrivalDate($arrivalDate);
        $this->setArrivalGeoLocation($arrivalCoordinates);
    }

    public function setFlightDestination($flightDestination) {
        $this->setValue(AVPType::FLIGHT_DESTINATION_TYPE, $flightDestination);
    }

    public function getFlightDestination() {
        return $this->getValue(AVPType::FLIGHT_DESTINATION_TYPE);
    }
}