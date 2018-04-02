<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;

require_once __DIR__."/NewUserRegistrationResponseUser.php";

class NewUserRegistrationResponseData
{
    /** @var int $usersRegistered */
    private $usersRegistered;

    /** @var NewUserRegistrationResponseUser[] $users*/
    private $users;

    /**
     * @param int $usersRegistered
     */
    public function setUsersRegistered($usersRegistered)
    {
        $this->usersRegistered = $usersRegistered;
    }

    /**
     * @return int
     */
    public function getUsersRegistered()
    {
        return $this->usersRegistered;
    }

    /**
     * @param NewUserRegistrationResponseUser[] $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @return NewUserRegistrationResponseUser[]
     */
    public function getUsers()
    {
        return $this->users;
    }
}