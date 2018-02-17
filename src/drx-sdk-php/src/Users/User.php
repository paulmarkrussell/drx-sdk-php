<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class User
{
    /** @var string $identifierType */
    private $identifierType;

    /** @var string $identifier */
    private $identifier;

    /** @var bool $isRegistered */
    private $isRegistered = false;

    /** @var string $guid */
    private $guid;

    /** @var string $rms */
    private $rms;

    public static function create($identifierType, $identifier, $guid, $rms)
    {
        $ret = new User();
        $ret->identifierType = $identifierType;
        $ret->identifier = $identifier;
        $ret->guid = $guid;
        $ret->isRegistered = $ret->guid != null;
        $ret->rms = $rms;
        return $ret;
    }

    /**
     * @return string
     */
    public function getIdentifierType()
    {
        return $this->identifierType;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * @return string
     */
    public function getRms()
    {
        return $this->rms;
    }

    /**
     * @return bool
     */
    public function isRegistered()
    {
        return $this->isRegistered;
    }
}