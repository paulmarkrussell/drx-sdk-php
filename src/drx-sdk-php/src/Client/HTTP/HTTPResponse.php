<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 17:47
 */

namespace Dreceiptx\Client;


class HTTPResponse
{

    /** @var string $content */
    private $content;
    /** @var int $status */
    private $status;
    /** @var string $errorMessage */
    private $errorMessage;

    /**
     * HTTPResponse constructor.
     * @param string $content
     * @param int $status
     * @param string $errorMessage
     */
    public function __construct($content, $status, $errorMessage)
    {
        $this->status = $status;
        $this->content = $content;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
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