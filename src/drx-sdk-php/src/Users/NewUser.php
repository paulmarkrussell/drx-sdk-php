<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class NewUser
{
    /** @var string $email */
    private $email;

    /** @var string[] $identifiers */
    private $identifiers;

    /** @var string[] $config */
    private $config;

    /** @var bool $addEmailAsIdentifier */
    private $addEmailAsIdentifier = true;


    public function __construct($email, $identifiers, $config, $addEmailAsIdentifier = true)
    {
        $this->email = $email;
        $this->identifiers = $identifiers;
        $this->config = $config;
        $this->addEmailAsIdentifier = $addEmailAsIdentifier;
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
     * @return string[]
     */
    public function getIdentifiers()
    {
        return $this->identifiers;
    }

    /**
     * @param string $type
     * @param string $value
     */
    public function setIdentifier($type, $value) {
        if($this->identifiers == null) {
            $this->identifiers = array();
        }
        $this->identifiers[$type] = $value;
    }

    /**
     * @return string[]
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setConfigOption($key, $value)
    {
        if ($this->config == null) {
            $this->config = array();
        }
        $this->config[$key] = $value;
    }

    /**
     * @param bool $addEmailAsIdentifier
     */
    public function setAddEmailAsIdentifier($addEmailAsIdentifier)
    {
        $this->addEmailAsIdentifier = $addEmailAsIdentifier;
    }

    /**
     * @return bool
     */
    public function isAddEmailAsIdentifier()
    {
        return $this->addEmailAsIdentifier;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->email = $this->email;
        $ret->identifiers = $this->identifiers;
        $ret->config = $this->config;
        $ret->addEmailAsIdentifier = $this->addEmailAsIdentifier;
        return \Utils::removeNullProperties($ret);
    }
}