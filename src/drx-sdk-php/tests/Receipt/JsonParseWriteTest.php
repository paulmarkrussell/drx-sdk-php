<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

require_once __DIR__ . "/../../src/Receipt/Invoice/Invoice.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__ . "/../../src/Receipt/AllowanceCharge/SettlementType.php";
require_once __DIR__ . "/../../src/Receipt/DigitalReceiptContainer.php";
require_once __DIR__."/TestUtils.php";
require_once __DIR__."/../ObjectComparator.php";

class InvoiceTotalTest extends \PHPUnit\Framework\TestCase
{
    public function testSample1() {
        $this->assertTrue(TestUtils::testReceipt(__DIR__."/../../../../samples/sample01.json"));
        $this->assertTrue(TestUtils::testReceipt(__DIR__."/../../../../samples/sample02.json"));
        $this->assertTrue(TestUtils::testReceipt(__DIR__."/../../../../samples/sample03.json"));
    }
}