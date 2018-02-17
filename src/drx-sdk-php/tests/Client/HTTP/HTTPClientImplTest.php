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
        $client = new HTTPClientImpl();
        $response = $client->get("https://isitchristmas.com/");
        $this->assertEquals("NEM", $response->getContent());
    }
}