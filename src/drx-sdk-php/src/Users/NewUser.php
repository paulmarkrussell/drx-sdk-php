<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;

require_once __DIR__."/ConfigOption.php";
require_once __DIR__."/MetaData.php";

class NewUser implements \JsonSerializable
{
    /** @var string $userEmail */
    private $userEmail;

    /** @var string $internalId */
    private $internalId;

    /** @var ConfigOption[] $config */
    private $config;

    /** @var MetaData[] $metaData */
    private $metaData;


    public function __construct($userEmail, $internalId, $config = null, $metaData = null)
    {
        $this->userEmail = $userEmail;
        $this->internalId = $internalId;
        $this->config = $config;
        $this->metaData = $metaData;
    }

    /**
     * @param string $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param string $internalId
     */
    public function setInternalId($internalId)
    {
        $this->internalId = $internalId;
    }

    /**
     * @return string
     */
    public function getInternalId()
    {
        return $this->internalId;
    }

    /**
     * @param \Dreceiptx\Users\ConfigOption[] $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function addConfig($option, $value) {
        if($this->config == null) {
            $this->config = array();
        }
        array_push($this->config, new ConfigOption($option, $value));
    }

    /**
     * @return \Dreceiptx\Users\ConfigOption[]
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param \Dreceiptx\Users\MetaData[] $metaData
     */
    public function setMetaData($metaData)
    {
        $this->metaData = $metaData;
    }

    public function addMetaData($type, $value) {
        if($this->metaData == null) {
            $this->metaData = array();
        }
        array_push($this->metaData, new MetaData($type, $value));
    }
    /**
     * @return \Dreceiptx\Users\MetaData[]
     */
    public function getMetaData()
    {
        return $this->metaData;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->userEmail = $this->userEmail;
        $ret->internalId = $this->internalId;
        $ret->config = $this->config;
        $ret->metaData = $this->metaData;
        return \Utils::removeNullProperties($ret);
    }
}