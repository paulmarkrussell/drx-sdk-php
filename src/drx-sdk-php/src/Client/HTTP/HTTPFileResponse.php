<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 17:47
 */

namespace Dreceiptx\Client;


class HTTPFileResponse
{

    /** @var bool $success */
    private $success;
    /** @var string $path */
    private $path;
    /** @var int $status */
    private $status;
    /** @var string $errorMessage */
    private $errorMessage;

    /**
     * HTTPResponse constructor.
     * @param bool $success
     * @param string $path
     * @param int $status
     * @param string $errorMessage
     */
    public function __construct($success, $path, $status, $errorMessage)
    {
        $this->success = $success;
        $this->path = $path;
        $this->status = $status;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}