<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 18:41
 */

namespace Dreceiptx\Receipt\Document;
require_once __DIR__."/../../Utils/Utils.php";

class DocumentIdentification implements \JsonSerializable
{
    private $standard;
    private $typeVersion;
    private $type;
    private $instanceIdentifier;
    private $multipleType;
    private $creationDateAndTime;

    /**
     * @param string $standard
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;
    }

    /**
     * @param string $typeVersion
     */
    public function setTypeVersion($typeVersion)
    {
        $this->typeVersion = $typeVersion;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $instanceIdentifier
     */
    public function setInstanceIdentifier($instanceIdentifier)
    {
        $this->instanceIdentifier = $instanceIdentifier;
    }

    /**
     * @param boolean $multipleType
     */
    public function setMultipleType($multipleType)
    {
        $this->multipleType = $multipleType;
    }

    /**
     * @param \DateTime $creationDateAndTime
     */
    public function setCreationDateAndTime($creationDateAndTime)
    {
        $this->creationDateAndTime = $creationDateAndTime;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->standard = $this->standard;
        $ret->typeVersion = $this->typeVersion;
        $ret->type = $this->type;
        $ret->instanceIdentifier = $this->instanceIdentifier;
        $ret->multipleType = $this->multipleType;
        $ret->creationDateAndTime = $this->creationDateAndTime->format("Y-m-d\TH:i:sP");
        return \Utils::removeNullProperties($ret);
    }
}