<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 18:27
 */

namespace Dreceiptx\Client\Response;


class UserListResponse
{
    /**
     * @var User[] $users
     */
    private $users;

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }
}