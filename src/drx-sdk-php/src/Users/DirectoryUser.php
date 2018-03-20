<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class DirectoryUser
{
    private $email;
    private $guid;
    private $rms;

    public function __construct($email, $guid, $rms)
    {
        $this->email = $email;
        $this->guid = $guid;
        $this->rms = $rms;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @return mixed
     */
    public function getRms()
    {
        return $this->rms;
    }
}