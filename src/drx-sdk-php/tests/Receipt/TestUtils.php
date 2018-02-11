<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-11
 * Time: 10:50
 */

class TestUtils
{
    public static function createLineItem($quantity, $price) {
        return \Dreceiptx\Receipt\LineItem\LineItem::create("Brand", "Name", "Line item description", $quantity, $price);
    }

    public static function createLineItemWithTax($quantity, $price, $tax) {
        $lineItem = \Dreceiptx\Receipt\LineItem\LineItem::create("Brand", "Name", "Line item description", $quantity, $price);
        $lineItem->addTax("Category code", $tax, "Type code");
        return $lineItem;
    }

    public static function createAllowanceWithTax($amount, $tax) {
        $taxes = array();
        array_push($taxes, \Dreceiptx\Receipt\Tax\Tax::create("Category code", $tax, "Type code"));
        return TestUtils::createAllowance($amount, $taxes);
    }

    public static function createAllowance($amount, $taxes) {
        return \Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge::create(
            \Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType::ALLOWANCE,
            \Dreceiptx\Receipt\AllowanceCharge\AllowanceChargeType::CREDIT_CUSTOMER_ACCOUNT,
            $amount,
            $taxes,
            \Dreceiptx\Receipt\AllowanceCharge\SettlementType::GeneralDiscount,
            "Discount"
        );
    }

    public static function createChargeWithTax($amount, $tax) {
        $taxes = array();
        array_push($taxes, \Dreceiptx\Receipt\Tax\Tax::create("Category code", $tax, "Type code"));
        return TestUtils::createCharge($amount, $taxes);
    }

    public static function createCharge($amount, $taxes) {
        return \Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge::create(
            \Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType::CHARGE,
            \Dreceiptx\Receipt\AllowanceCharge\AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $taxes,
            \Dreceiptx\Receipt\AllowanceCharge\SettlementType::PackagingFee,
            "Cost of pretty package"
        );
    }
}