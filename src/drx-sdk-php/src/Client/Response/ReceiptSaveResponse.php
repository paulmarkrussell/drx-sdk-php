<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-22
 * Time: 19:56
 */

namespace Dreceiptx\Client\Response;


class ReceiptSaveResponse
{
    /** @var boolean $success */
    private $success;
    /** @var int $httpCode*/
    private $httpCode;
    /** @var int $code*/
    private $code;
    /** @var string $exceptionMessage */
    private $exceptionMessage;
    /** @var \stdClass $responseData */
    private $responseData;

    public function __construct($success, $httpCode, $code, $responseData, $exceptionMessage)
    {
        $this->success = $success;
        $this->httpCode = $httpCode;
        $this->responseData = $responseData;
        $this->code = $code;
        $this->exceptionMessage = $exceptionMessage;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
    }

    /**
     * @return int
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @return \stdClass
     */
    public function getResponseData()
    {
        return $this->responseData;
    }
}