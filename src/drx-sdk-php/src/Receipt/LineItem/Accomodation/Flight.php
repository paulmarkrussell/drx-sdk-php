<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 07:04
 */

namespace Dreceiptx\Receipt\LineItem\Accomodation;

use Dreceiptx\Receipt\Ecom\AVPType;
use Dreceiptx\Receipt\LineItem\TradeItemIdentification;
use Dreceiptx\Receipt\LineItem\TransactionalTradeItem;

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


        $tradeItem = new TransactionalTradeItem();
        $tradeItem->setTradeItemDescriptionInformation($tradeItemDescriptionInformation);

        $tradeItemIdentification = TradeItemIdentification::create(LineItem::LINE_ITEM_TYPE_IDENTIFIER, Accomodation::LINE_ITEM_TYPE_VALUE);
        array_push($tradeItem->getAdditionalTradeItemIdentification(), $tradeItemIdentification);

        $lineItem->setTransactionalTradeItem($tradeItem);

        return $lineItem;
    }

    /**
     * @param Flight $lineItem
     */
    public static function createFromLineItem($lineItem) {
        $ret = new Flight();
        $ret->setLineItemNumber($lineItem->getLineItemNumber());
        $ret->setCreditLineIndicator($lineItem->getCreditLineIndicator());
        $ret->setCreditReason($lineItem->getCreditReason());
        $ret->setAmountExclusiveAllowancesCharges($lineItem->getAmountExclusiveAllowancesCharges());
        $ret->setAmountInclusiveAllowancesCharges($lineItem->getAmountInclusiveAllowancesCharges());
        $ret->setInvoicedQuantity($lineItem->getInvoicedQuantity());
        $ret->setItemPriceExclusiveAllowancesCharges($lineItem->getItemPriceExclusiveAllowancesCharges());
        $ret->setNote($lineItem->getNote());
        $ret->setBillingCostCentre($lineItem->getBillingCostCentre());
        $ret->setTransactionalTradeItem($lineItem->getTransactionalTradeItem());
        $ret->setInvoiceAllowanceCharge($lineItem->getInvoiceAllowanceCharge());
        $ret->setInvoiceLineTaxInformation($lineItem->getInvoiceLineTaxInformation());
        $ret->setAvpList($lineItem->getAvpList());
        $ret->setShipFrom($lineItem->getShipFrom());
        $ret->setShipTo($lineItem->getShipTo());
        $ret->setDespatchInformation($lineItem->getDespatchInformation());
        return ret;
    }


    public function getAirlineName() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getBrandName();
    }

    public function getItinerary() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getDescriptionShort();
    }

    public function getItineraryDescription() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getTradeItemDescription();
    }

    public function getFlightType() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getTradeItemGroupIdentificationCode();
    }

    public function setPassengerName($passengerName) {
        $this->setValue(AVPType::PASSENGER_NAME, $passengerName);
    }

    public function getPassengerName() {
        return $this->getValue(AVPType::PASSENGER_NAME);
    }

    public function setPassengerNameRecord($passengerNameRecord) {
        $this->setValue(AVPType::PASSENGER_NAME_RECORD, $passengerNameRecord);
    }

    public function getPassengerNameRecord() {
        return $this->getValue(AVPType::PASSENGER_NAME_RECORD);
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