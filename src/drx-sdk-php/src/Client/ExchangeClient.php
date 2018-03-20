<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:41
 */

namespace Dreceiptx\Client;

require_once __DIR__."/../Users/User.php";
require_once __DIR__."/../Users/NewUser.php";
require_once __DIR__."/../Users/NewUserRegistrationResult.php";
require_once __DIR__."/../Receipt/DRxDigitalReceipt.php";

use Dreceiptx\Client\Response\UserResponse;
use Dreceiptx\Receipt\DRxDigitalReceipt;
use Dreceiptx\Users\NewUser;
use Dreceiptx\Users\User;

interface ExchangeClient
{

    /**
     * @param string $identifierType
     * @param string $identifier
     * @return UserResponse
     */
    public function searchUser($identifierType, $identifier);

    /**
     * @param string $identifierType
     * @param string $identifier
     * @return UserResponse
     */
    public function searchUserInDirectory($identifierType, $identifier);

    /**
     * @param string $identifierType
     * @param string[] $userIdentifiers
     * @return User[]
     */
    public function searchUsers($identifierType, $userIdentifiers);

    /**
     * @param string $accountId
     * @param int $count
     * @return UserResponse
     */
    public function getAccountUsers($accountId, $count);

    /**
     * @param DRxDigitalReceipt $receipt
     * @return string
     */
    public function sendProductionReceipt($receipt);

    /**
     * @param DRxDigitalReceipt $receipt
     * @return string
     */
    public function sendDryRunReceipt($receipt);

    /**
     * @param NewUser $user
     * @return NewUserRegistrationResult
     */
    public function registerNewUser($user);

    /**
     * @param NewUser[] $users
     * @return NewUserRegistrationResult[]
     */
    public function registerNewUsers($users);

    /**
     * @param string $receiptId
     * @return DRxDigitalReceipt
     */
    public function lookupReceipt($receiptId);

    /**
     * @param string $receiptId
     * @return boolean
     */
    public function downloadReceiptPDF($receiptId);

    public function lookupMerchant($merchantId);

}