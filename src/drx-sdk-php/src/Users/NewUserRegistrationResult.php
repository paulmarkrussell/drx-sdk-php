<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class NewUserRegistrationResult
{
    /** @var bool $success */
    private $success;

    /** @var int $code */
    private $code;

    /** @var string $message */
    private $message;

    /** @var string $guid */
    private $guid;

    public static function create($success, $code, $message, $guid) {
        $ret = new NewUserRegistrationResult();
        $ret->success = $success;
        $ret->code = $code;
        $ret->message = $message;
        $ret->guid = $guid;
        return $ret;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }
}