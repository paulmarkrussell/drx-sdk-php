<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;

require_once __DIR__."/NewUserRegistrationResponseData.php";

class NewUserRegistrationResult
{
    /** @var bool $success */
    private $success;

    /** @var int $code */
    private $code;

    /** @var NewUserRegistrationResponseData $responseData */
    private $responseData;

    /**
     * @var int $httpCode
     */
    private $httpCode;

    /**
     * @var string $errorMessage
     */
    private $exceptionMessage;

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

    /**
     * @param NewUserRegistrationResponseData $responseData
     */
    public function setResponseData($responseData)
    {
        $this->responseData = $responseData;
    }

    /**
     * @return NewUserRegistrationResponseData
     */
    public function getResponseData()
    {
        return $this->responseData;
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
     * @param string $exceptionMessage
     */
    public function setExceptionMessage($exceptionMessage)
    {
        $this->exceptionMessage = $exceptionMessage;
    }

    /**
     * @return string
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
    }
}