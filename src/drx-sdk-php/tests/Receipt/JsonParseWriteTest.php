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
        $this->assertTrue(InvoiceTotalTest::testReceipt(__DIR__."/../../../../samples/sample01.json"));
        $this->assertTrue(InvoiceTotalTest::testReceipt(__DIR__."/../../../../samples/sample02.json"));
        $this->assertTrue(InvoiceTotalTest::testReceipt(__DIR__."/../../../../samples/sample03.json"));
    }

    private static function testReceipt($filePath) {
        print "Parsing file ".$filePath."\n";
        $text = file_get_contents($filePath);
        $json = json_decode($text);
        $receipt = \Dreceiptx\Receipt\DigitalReceiptContainer::fromJson($json)->jsonSerialize();
        return(ObjectComparator::compare($json, json_decode(json_encode($receipt))));
    }
}