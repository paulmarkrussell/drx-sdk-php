<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-13
 * Time: 17:47
 */

namespace Dreceiptx\Client;

require_once __DIR__."/../Users/User.php";
require_once __DIR__."/../Users/NewUser.php";
require_once __DIR__."/../Users/MetaData.php";
require_once __DIR__."/../Users/ConfigOption.php";
require_once __DIR__."/../Users/NewUserRegistrationResult.php";
require_once __DIR__."/../Receipt/DRxDigitalReceipt.php";
require_once __DIR__."/../Config/ConfigKeys.php";
require_once __DIR__."/../Config/ConfigManager.php";
require_once __DIR__."/ExchangeClient.php";
require_once __DIR__."/ValueExchangeCredentials.php";
require_once __DIR__."/Response/ReceiptSaveResponse.php";
require_once __DIR__."/Response/UserResponse.php";
require_once __DIR__."/Response/MerchantResponse.php";


use Dreceiptx\Client\Response\MerchantResponse;
use Dreceiptx\Client\Response\ReceiptSaveResponse;
use Dreceiptx\Client\Response\UserResponse;
use Dreceiptx\Config\ConfigKeys;
use Dreceiptx\Config\ConfigManager;
use Dreceiptx\Receipt\DigitalReceiptContainer;
use Dreceiptx\Receipt\DRxDigitalReceipt;
use Dreceiptx\Users\NewUser;
use Dreceiptx\Users\NewUserRegistrationResult;
use Dreceiptx\Users\UserIdentifierType;

class Client implements ExchangeClient
{
    const CONTENT_TYPE_JSON = "application/json";
    const CONTENT_TYPE_XML = "application/xml";
    const CONTENT_TYPE_PDF = "application/pdf";
    const HTTPS = "https";

    private $userAgent;
    private $exchangeCredentials;
    private $exchangeProtocol = Client::HTTPS;
    private $directoryProtocol = Client::HTTPS;
    private $exchangeApiHost;
    private $receiptVersion;
    private $directoryHost;
    private $userVersion;
    private $downloadDirectory;
    /** @var HTTPClient $httpClient */
    private $httpClient;

    /**
     * Client constructor.
     * @param ConfigManager $configManager
     */
    public function __construct($configManager, $httpClient) {
        $this->exchangeApiHost = $this->validateConfigOption($configManager, ConfigKeys::ExchangeHost);
        $this->directoryHost = $this->validateConfigOption($configManager, ConfigKeys::DirectoryHost);
        $this->receiptVersion = $configManager->getConfigValue(ConfigKeys::ReceiptVersion);
        $this->userVersion = $configManager->getConfigValue(ConfigKeys::UserVersion);
        $this->downloadDirectory = $configManager->getConfigValue(ConfigKeys::DownloadDirectory);
        if($configManager->exists(ConfigKeys::ExchangeProtocol)) {
            $this->exchangeProtocol = $configManager->getConfigValue(ConfigKeys::ExchangeProtocol);
        }
        if($configManager->exists(ConfigKeys::DirectoryProtocol)) {
            $this->directoryProtocol = $configManager->getConfigValue(ConfigKeys::DirectoryProtocol);
        }
       // $this->exchangeApiHost = $this->exchangeProtocol."://".$this->exchangeApiHost;
        //$this->directoryHost = $this->directoryProtocol."://".$this->directoryHost;

        $this->exchangeCredentials = new ValueExchangeCredentials(
            $this->validateConfigOption($configManager, ConfigKeys::APIRequesterId),
            $this->validateConfigOption($configManager, ConfigKeys::APIKey),
            $this->validateConfigOption($configManager, ConfigKeys::APISecret)
        );
        $this->httpClient = $httpClient;
    }

    /**
     * @return ValueExchangeCredentials
     */
    public function getExchangeCredentials()
    {
        return $this->exchangeCredentials;
    }

    /**
     * @return string
     */
    public function getExchangeApiHost()
    {
        return $this->exchangeApiHost;
    }

    /**
     * @return string
     */
    public function getReceiptVersion()
    {
        return $this->receiptVersion;
    }

    /**
     * @return string
     */
    public function getDirectoryHost()
    {
        return $this->directoryHost;
    }

    /**
     * @return string
     */
    public function getUserVersion()
    {
        return $this->userVersion;
    }

    /**
     * @param ConfigManager $configManager
     * @param string $key
     * @return string
     */
    private function validateConfigOption($configManager, $key) {
        if ($configManager->exists($key)) {
            return $configManager->getConfigValue($key);
        } else {
            throw new \Exception("Required config parameter ".$key." not suplied.");
        }
    }

    /**
     * @param string $identifierType
     * @param string $identifier
     * @return UserResponse
     */
    public function searchUserInDirectory($identifierType, $identifier)
    {
        $params = ["idtype" => $identifierType, "identifiers" => $identifier];
        $response = $this->httpClient->get($this->directoryHost."/user", $params, $this->getHeaders());
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $userResponse = $mapper->map(json_decode($response->getContent()), new UserResponse());
            $userResponse->setType(UserResponse::TYPE_DIRECTORY_USER);
            $userResponse->setIdentificationType($identifierType);
            $userResponse->setHttpCode($response->getStatus());
            $userResponse->setExceptionMessage($response->getErrorMessage());
            return $userResponse;

        } else {
            throw new \Exception("Error getting user, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param string $identifierType
     * @param string $identifier
     * @return UserResponse
     */
    public function searchUser($identifierType, $identifier)
    {
        if ($identifierType == UserIdentifierType::GUID) {
            $url = $this->exchangeApiHost."/user/".$identifier;
            $params = [];
        } else {
            $url = $this->exchangeApiHost."/user";
            $params = ["idtype" => $identifierType, "identifiers" => $identifier];
        }
        $response = $this->httpClient->get($url, $params, $this->getHeaders());
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $userResponse = $mapper->map(json_decode($response->getContent()), new UserResponse());
            $userResponse->setType(UserResponse::TYPE_USER);
            $userResponse->setHttpCode($response->getStatus());
            $userResponse->setExceptionMessage($response->getErrorMessage());
            return $userResponse;

        } else {
            throw new \Exception("Error getting user, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param string $accountId
     * @param int $count
     * @return UserResponse
     */
    public function getAccountUsers($accountId, $count = null)
    {
        $url = $this->exchangeApiHost."/user";
        $params = ["acid" => $accountId];
        if ($count != null) {
            $params["ps"] = $count;
        }
        $response = $this->httpClient->get($url, $params, $this->getHeaders());
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $userResponse = $mapper->map(json_decode($response->getContent()), new UserResponse());
            $userResponse->setType(UserResponse::TYPE_ACCOUNT_USERS);
            $userResponse->setHttpCode($response->getStatus());
            $userResponse->setExceptionMessage($response->getErrorMessage());
            return $userResponse;

        } else {
            throw new \Exception("Error getting user, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }



    /**
     * @param string $identifierType
     * @param string[] $userIdentifiers
     * @return UserResponse
     * @throws \JsonMapper_Exception
     */
    public function searchUsers($identifierType, $userIdentifiers)
    {
        $encodedIdentifiers = array();
        foreach ($userIdentifiers as $identifier) {
            array_push($encodedIdentifiers, urlencode($identifier));
        }
        $params = ["idtype" => $identifierType, "identifiers" => implode("%3B", $encodedIdentifiers)];
        $response = $this->httpClient->get($this->directoryHost."/user", $params);
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $userResponse = $mapper->map(json_decode($response->getContent()), new UserResponse());
            $userResponse->setType(UserResponse::TYPE_USER_LIST);
            $userResponse->setIdentificationType($identifierType);
            $userResponse->setHttpCode($response->getStatus());
            $userResponse->setExceptionMessage($response->getErrorMessage());
            return $userResponse;

        } else {
            throw new \Exception("Error getting users, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param DRxDigitalReceipt $receipt
     * @return ReceiptSaveResponse
     */
    public function sendProductionReceipt($receipt)
    {
        return $this->sendReceipt($receipt, "/receipt", true);
    }

    /**
     * @param DRxDigitalReceipt $receipt
     * @return string
     */
    public function sendDryRunReceipt($receipt)
    {
        return $this->sendReceipt($receipt, "/labs/dryrun/receipt", false);
    }

    private function sendReceipt($receipt, $path, $isProduction) {
        $container = new DigitalReceiptContainer();
        $container->setDRxDigitalReceipt($receipt);
        $headers = $this->getReceiptHeaders($isProduction);
        $response = $this->httpClient->post($this->exchangeApiHost.$path, json_encode($container->jsonSerialize()), $headers);
        print("\n");
        print_r($response);
        print("\n");
        $responseObject = json_decode($response->getContent());
        print("\n");
        print_r($responseObject);
        print("\n");
        $errorMessage = $response->getErrorMessage();
        if(isset($responseObject->exceptionMessage)) {
            $errorMessage = $responseObject->exceptionMessage;
        }
        $success = false;
        $responseData = null;
        $code = -1;
        if ($responseObject != null) {
            foreach ($responseObject as $key => $value) {
                if ($key == "success") {
                    $success = $value;
                } else if ($key == "code") {
                    $code = $value;
                } else if ($key == "responseData") {
                    $responseData = $value;
                }
            }
        }
        $result = new ReceiptSaveResponse($success, $response->getStatus(), $code, $responseData, $errorMessage);
        return $result;

    }

    /**
     * @param NewUser $user
     * @return NewUserRegistrationResult
     */
    public function registerNewUser($user)
    {
        $url = $this->exchangeApiHost."/user";
        print($url."\n");
        $response = $this->httpClient->post($url, json_encode($user->jsonSerialize()), $this->getHeaders());
        print("RESPONSE\n");
        print_r($response);
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 201){
            $mapper = new \JsonMapper();
            $userResponse = $mapper->map(json_decode($response->getContent()), new NewUserRegistrationResult());
            $userResponse->setHttpCode($response->getStatus());
            $userResponse->setExceptionMessage($response->getErrorMessage());
            return $userResponse;

        } else {
            throw new \Exception("Error getting user, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param NewUser[] $users
     * @return NewUserRegistrationResult[]
     */
    public function registerNewUsers($users)
    {
        $url = $this->exchangeApiHost."/user";
        print($url."\n");
        $body = [];
        foreach ($users as $user) {
            array_push($body, $user->jsonSerialize());
        }
        $response = $this->httpClient->post($url, json_encode($body), $this->getHeaders());
        print("RESPONSE\n");
        print_r($response);
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $userResponse = $mapper->map(json_decode($response->getContent()), new UserResponse());
            $userResponse->setType(UserResponse::TYPE_ACCOUNT_USERS);
            $userResponse->setHttpCode($response->getStatus());
            $userResponse->setExceptionMessage($response->getErrorMessage());
            return $userResponse;

        } else {
            throw new \Exception("Error getting user, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param string $receiptId
     * @return DRxDigitalReceipt
     */
    public function lookupReceipt($receiptId)
    {
        $response = $this->httpClient->get("/receipt/".$receiptId);
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $receipt = $mapper->map(json_decode($response->getContent()), new DigitalReceiptContainer());
            return $receipt->getDRxDigitalReceipt();

        } else {
            throw new \Exception("Error getting receipt, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param string $receiptId
     * @return boolean
     */
    public function downloadReceiptPDF($receiptId)
    {
        $response = $this->httpClient->get("/receipt/".$receiptId);
        if($response->getStatus() == 404) {
            return false;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $receipt = $mapper->map(json_decode($response->getContent()), new DigitalReceiptContainer());
            return true;

        } else {
            throw new \Exception("Error getting receipt, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    /**
     * @param $merchantId
     * @return null|MerchantResponse
     * @throws \Exception
     * @throws \JsonMapper_Exception
     */
    public function lookupMerchant($merchantId)
    {
        $response = $this->httpClient->get("https://merchants.dreceiptx.net/location/".$merchantId."/info.json");
        if($response->getStatus() == 404) {
            return null;
        } else if($response->getStatus() == 200){
            $mapper = new \JsonMapper();
            $merchantResponse = $mapper->map(json_decode($response->getContent()), new MerchantResponse());
            $merchantResponse->setHttpCode($response->getStatus());
            $merchantResponse->setExceptionMessage($response->getErrorMessage());
            return $merchantResponse;

        } else {
            throw new \Exception("Error getting users, server responded with code ".$response->getStatus().": ".$response->getErrorMessage() );
        }
    }

    private function getReceiptHeaders($isProduction) {
        $headers = $this->getHeaders();
        array_push($headers, "x-drx-receipt-type: ".($isProduction?"production":"dry-run"));
        return $headers;
    }

    private function getHeaders() {
        $micro_date = microtime();
        $date_array = explode(" ",$micro_date);
        $timestamp = $date_array[1];

        $headers = array();
        array_push($headers, "x-drx-version: ".$this->receiptVersion);
        array_push($headers, "x-drx-requester: ".$this->exchangeCredentials->getRequestId());
        array_push($headers, "x-drx-timestamp: ".$timestamp);
        array_push($headers, "Content-Type: application/json");
        return $headers;
    }
}