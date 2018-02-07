<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-07
 * Time: 07:04
 */

require_once __DIR__."/../LineItem.php";
require_once __DIR__."/../TransactionalTradeItem.php";
require_once __DIR__."/../TradeItemDescriptionInformation.php";
require_once __DIR__."/../TradeItemIdentification.php";

class MaterialGeneric extends \Dreceiptx\Receipt\LineItem\LineItem
{
    const LINE_ITEM_TYPE_VALUE = "CON0001";

    public static function create($brandName, $productName, $productDescription, $quantity, $price) {

        $tradeItemDescription = new \Dreceiptx\Receipt\LineItem\TradeItemDescriptionInformation();
        $tradeItemDescription->setBrandName($brandName);
        $tradeItemDescription->setDescriptionShort($productName);
        $tradeItemDescription->setTradeItemDescription($productDescription);

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
        $tradeItemIdentification->setAdditionalTradeItemIdentificationValue(MaterialGeneric::LINE_ITEM_TYPE_VALUE);
        $tradeItem->setAdditionalTradeItemIdentification([

        ]);

        $lineItem->setTransactionalTradeItem($tradeItem);

        return $lineItem;
    }

    public function getBrandName() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getBrandName();
    }

    public function getProductName() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getDescriptionShort();
    }

    public function getProductDescription() {
        return $this->getTransactionalTradeItem()->getTradeItemDescriptionInformation()->getTradeItemDescription();
    }
}