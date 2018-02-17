<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-16
 * Time: 17:54
 */

namespace Dreceiptx\Client;


interface ExchangeCredentials
{
    public function getRequestId();
    public function getApiKey();
    public function getApiSecret();

}