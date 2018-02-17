<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-16
 * Time: 17:55
 */

namespace Dreceiptx\Client;


class ValueExchangeCredentials implements ExchangeCredentials
{

    private $requestId;
    private $apiKey;
    private $apiSecret;

    public function __construct($requestId, $apiKey, $apiSecret)
    {
        $this->requestId = $requestId;
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }
}