<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 18:22
 */

namespace Dreceiptx\Client\Response;

use Dreceiptx\Users\DirectoryUser;
use Dreceiptx\Users\User;

class UserResponse
{
    const TYPE_DIRECTORY_USER = "DIRECTORY_USER";
    const TYPE_USER = "USER";
    const TYPE_USER_LIST = "USER_LIST";
    const TYPE_ACCOUNT_USERS = "ACCOUNT_USERS";

    /**
     * @var string $identificationType
     */
    private $identificationType;

    /**
     * @var string $type
     */
    private $type;

    /**
     * @var boolean $success
     */
    private $success;
    /**
     * @var int $code
     */
    private $code;

    private $responseData;

    /**
     * @var int $httpCode
     */
    private $httpCode;

    /**
     * @var strimg $exceptionMessage
     */
    private $exceptionMessage;

    /**
     * @param string $identificationType
     */
    public function setIdentificationType($identificationType)
    {
        $this->identificationType = $identificationType;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;
    }

    public function getRawResponseData()
    {
        return $this->responseData;
    }

    /**
     * @throws \Exception
     * @return User
     */
    public function getUser() {
        if ($this->type != UserResponse::TYPE_USER) {
            throw new \Exception("Can't get user from response of type ".$this->type);
        }
        $user = new User();
        foreach ($this->responseData as $key => $value) {
            if ($key == "guid") {
                $user->setGuid($value);
            } else if ($key == "email") {
                $user->setEncodedEmail($value);
            } else if ($key == "emailMask") {
                $user->setEmailMask($value);
            } else if ($key == "status") {
                $user->setStatus($value);
            } else if ($key == "history") {
                $user->setHistory($value);
            } else if ($key == "account") {
                $user->setAccont($value);
            } else if ($key == "rms") {
                $user->setRms($value);
            } else if ($key == "organisation") {
                $user->setOrganisation($value);
            }
        }
        return $user;
    }

    /**
     * @throws \Exception
     * @return User[]
     */
    public function getUsers() {
        if ($this->type != UserResponse::TYPE_USER_LIST) {
            throw new \Exception("Can't get user list from response of type ".$this->type);
        }
        $users = [];
        foreach ($this->responseData->users as $responseUser) {
            $user = new User();
            $user->setGuid($responseUser->guid);
            $user->setEncodedEmail($responseUser->email);
            $user->setEmailMask($responseUser->emailMask);
            $user->setStatus($responseUser->status);
            $user->setHistory($responseUser->history);
            $user->setAccont($this->responseData->accountId);
            $user->setRms($responseUser->rms);
            $user->setOrganization($responseUser->organisation);
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @throws \Exception
     * @return DirectoryUser
     */
    public function getDirectoryUser() {
        if ($this->type != UserResponse::TYPE_DIRECTORY_USER) {
            throw new \Exception("Can't get directory user from response of type ".$this->type);
        }
    }

    /**
     * @param bool $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param int $httpCode
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param strimg $exceptionMessage
     */
    public function setExceptionMessage($exceptionMessage)
    {
        $this->exceptionMessage = $exceptionMessage;
    }

    /**
     * @return strimg
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
    }
}