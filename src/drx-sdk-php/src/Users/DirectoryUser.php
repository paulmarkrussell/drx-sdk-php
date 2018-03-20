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
    private $mobile;
    private $accorLeClub;

    /**
     * @param $data
     * @return DirectoryUser
     */
    public static function create($data) {
        $user = new DirectoryUser();
        foreach ($data as $key => $value) {
            if ($key == "guid") {
                $user->guid = $value;
            } else if ($key == "email") {
                $user->email = $value;
            } else if ($key == "rms") {
                $user->rms = $value;
            } else if ($key == "mobile") {
                $user->mobile = $value;
            } else if ($key == "accorLeClub") {
                $user->accorLeClub = $value;
            }
        }
        return $user;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $guid
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * @return mixed
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @param mixed $rms
     */
    public function setRms($rms)
    {
        $this->rms = $rms;
    }

    /**
     * @return mixed
     */
    public function getRms()
    {
        return $this->rms;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $accorLeClub
     */
    public function setAccorLeClub($accorLeClub)
    {
        $this->accorLeClub = $accorLeClub;
    }

    /**
     * @return mixed
     */
    public function getAccorLeClub()
    {
        return $this->accorLeClub;
    }
}