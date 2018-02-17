<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 18:22
 */

namespace Dreceiptx\Client\Response;


use Dreceiptx\Users\User;

class UserResponse
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}