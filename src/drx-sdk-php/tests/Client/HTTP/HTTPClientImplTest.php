<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-10
 * Time: 07:34
 */

namespace Test\Client\HTTP;

require_once __DIR__."/../../../src/Client/HTTP/HTTPClientImpl.php";
require_once __DIR__."/../../../src/Client/HTTP/HTTPResponse.php";

use Dreceiptx\Client\HTTPClientImpl;
use PHPUnit\Framework\TestCase;

class HTTPClientImplTest extends TestCase
{
    public function testSimpleGet()
    {
        // NOTE: you have to start the node test server for this to work
        $client = new HTTPClientImpl();
        $response = $client->get("localhost:8081");
        $this->assertEquals("Hello World", $response->getContent());
    }

    public function testGetWithParams()
    {
        // NOTE: you have to start the node test server for this to work
        $client = new HTTPClientImpl();
        $params = array("hello"=>"world", "goodby"=>"moon");
        $response = $client->get("localhost:8081/params", $params);
        $returnedParams = json_decode($response->getContent())->params;
        $this->assertEquals("world", $returnedParams->hello);
        $this->assertEquals("moon", $returnedParams->goodby);
    }

    public function testGetStatusCodes()
    {
        // NOTE: you have to start the node test server for this to work
        $client = new HTTPClientImpl();
        $response = $client->get("localhost:8081");
        $this->assertEquals(200, $response->getStatus());
        $response404 = $client->get("localhost:8081/nonexistent");
        $this->assertEquals(404, $response404->getStatus());
        $response500 = $client->get("localhost:8081/serverError");
        $this->assertEquals(500, $response500->getStatus());
        $response400 = $client->get("localhost:8081/badRequest");
        $this->assertEquals(400, $response400->getStatus());
    }
}