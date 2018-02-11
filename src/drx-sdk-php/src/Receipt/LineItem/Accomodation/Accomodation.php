<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 07:04
 */

namespace Dreceiptx\Receipt\LineItem\Accomodation;

use Dreceiptx\Receipt\Ecom\AVPType;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\LineItem\TradeItemIdentification;
use Dreceiptx\Receipt\LineItem\TransactionalTradeItem;

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


        $tradeItem = new TransactionalTradeItem();
        $tradeItem->setTradeItemDescriptionInformation($tradeItemDescriptionInformation);

        $tradeItemIdentification = TradeItemIdentification::create(LineItem::LINE_ITEM_TYPE_IDENTIFIER, Accomodation::LINE_ITEM_TYPE_VALUE);
        array_push($tradeItem->getAdditionalTradeItemIdentification(), $tradeItemIdentification);

        $lineItem->setTransactionalTradeItem($tradeItem);

        return $lineItem;
    }

    /**
     * @param Accomodation $lineItem
     */
    public static function createFromLineItem($lineItem) {
        $ret = new Accomodation();
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

    public function setProviderName($provider) {
        $this->setBrandName($provider);
    }

    public function getProviderName() {
        return $this->getBrandName();
    }

    public function getShortDescription() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getDescriptionShort();
    }

    public function getProductDescription() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getTradeItemDescription();
    }

    public function getAccomodationType() {
        return $this->getTransactionalTradeItemNotNull()->getTradeItemDescriptionInformationNotNull()->getTradeItemGroupIdentificationCode();
    }

    public function setPassengerName($passengerName) {
        $this->setValue(AVPType::PASSENGER_NAME, $passengerName);
    }

    public function getPassengerName() {
        return $this->getValue(AVPType::PASSENGER_NAME);
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