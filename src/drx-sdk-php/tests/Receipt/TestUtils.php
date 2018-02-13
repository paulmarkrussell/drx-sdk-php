<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-11
 * Time: 10:50
 */

namespace Dreceiptx\Receipt;

require_once __DIR__."/../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/ReceiptAllowanceCharge.php";
require_once __DIR__."/../../src/Receipt/AllowanceCharge/SettlementType.php";
require_once __DIR__."/../ObjectComparator.php";
require_once __DIR__."/../../src/Receipt/LineItem/LineItem.php";
require_once __DIR__."/../../src/Receipt/Tax/Tax.php";
require_once __DIR__."/../../src/Receipt/DigitalReceiptContainer.php";

use Dreceiptx\ObjectComparator;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceChargeType;
use Dreceiptx\Receipt\AllowanceCharge\AllowanceOrChargeType;
use Dreceiptx\Receipt\AllowanceCharge\ReceiptAllowanceCharge;
use Dreceiptx\Receipt\AllowanceCharge\SettlementType;
use Dreceiptx\Receipt\LineItem\LineItem;
use Dreceiptx\Receipt\Tax\Tax;

class TestUtils
{
    public static function createLineItem($quantity, $price) {
        return LineItem::create("Brand", "Name", "Line item description", $quantity, $price);
    }

    public static function createLineItemWithTax($quantity, $price, $tax) {
        $lineItem = LineItem::create("Brand", "Name", "Line item description", $quantity, $price);
        $lineItem->addTax("Category code", $tax, "Type code");
        return $lineItem;
    }

    public static function createAllowanceWithTax($amount, $tax) {
        $taxes = array();
        array_push($taxes, Tax::create("Category code", $tax, "Type code"));
        return TestUtils::createAllowance($amount, $taxes);
    }

    public static function createAllowance($amount, $taxes) {
        return ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::ALLOWANCE,
            AllowanceChargeType::CREDIT_CUSTOMER_ACCOUNT,
            $amount,
            $taxes,
            SettlementType::GeneralDiscount,
            "Discount"
        );
    }

    public static function createChargeWithTax($amount, $tax) {
        $taxes = array();
        array_push($taxes, Tax::create("Category code", $tax, "Type code"));
        return TestUtils::createCharge($amount, $taxes);
    }

    public static function createCharge($amount, $taxes) {
        return ReceiptAllowanceCharge::create(
            AllowanceOrChargeType::CHARGE,
            AllowanceChargeType::CHARGE_TO_BE_PAID_BY_CUSTOMER,
            $amount,
            $taxes,
            SettlementType::PackagingFee,
            "Cost of pretty package"
        );
    }

    public static function testReceipt($filePath) {
        print "Parsing file ".$filePath."\n";
        $text = file_get_contents($filePath);
        $json = json_decode($text);
        $receipt = DigitalReceiptContainer::fromJson($json)->jsonSerialize();
        return(ObjectComparator::compare($json, json_decode(json_encode($receipt))));
    }
}