<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Dreceiptx\Receipt;

require_once __DIR__."/TestUtils.php";

class JsonParseWriteTest extends \PHPUnit\Framework\TestCase
{
    public function testSample1() {
        $this->assertTrue(TestUtils::testReceipt(__DIR__."/../../../../samples/sample01.json"));
        $this->assertTrue(TestUtils::testReceipt(__DIR__."/../../../../samples/sample02.json"));
        $this->assertTrue(TestUtils::testReceipt(__DIR__."/../../../../samples/sample03.json"));
    }
}