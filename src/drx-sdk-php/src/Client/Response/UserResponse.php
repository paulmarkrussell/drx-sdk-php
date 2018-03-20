<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 18:22
 */

namespace Dreceiptx\Client\Response;

class UserResponse
{
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

    public function getResponseData()
    {
        return $this->responseData;
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