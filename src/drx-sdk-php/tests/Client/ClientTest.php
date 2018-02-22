<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Test\Client;

require_once __DIR__."/../../../src/Client/HTTP/HTTPClientImpl.php";
require_once __DIR__."/../../../src/Client/Client.php";
require_once __DIR__."/../../../src/Client/HTTP/HTTPResponse.php";
require_once __DIR__."/../../../src/Utils/Utils.php";

use Dreceiptx\Client\HTTPClientImpl;
use Dreceiptx\Client\Client;
use Dreceiptx\Receipt\DigitalReceiptBuilder;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testSimplePost()
    {
        $httpClient = new HTTPClientImpl();
        $client = new Client("",$httpClient);
        $receiptBuilder = new DigitalReceiptBuilder("");
        $receipt = $receiptBuilder->build();
        $response = $client->sendProductionReceipt($receipt);
        $this->assertEquals("Hello Post", $response->getContent());
    }
}