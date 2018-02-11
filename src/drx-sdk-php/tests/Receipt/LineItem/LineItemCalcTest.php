<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

require_once __DIR__ . "/../../../src/Receipt/Invoice/Invoice.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/AllowanceOrChargeType.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/AllowanceChargeType.php";
require_once __DIR__ . "/../../../src/Receipt/AllowanceCharge/SettlementType.php";

class LineItemCalcTest extends \PHPUnit\Framework\TestCase
{
    public function testNetTotalForZeroPrice() {
        $lineItem = new \Dreceiptx\Receipt\LineItem\LineItem();
        $this->assertEquals(0, $lineItem->getTotal());
    }
}