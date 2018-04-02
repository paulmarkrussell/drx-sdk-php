<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class NewUserRegistrationResponseUser
{
    /**
     * @var bool $success
     */
    private $success;

    /**
     * @var int $code
     */
    private $code;

    /**
     * @var string $email
     */
    private $email;

    /**
     * @var string $guid
     */
    private $guid;

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
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $guid
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }
}