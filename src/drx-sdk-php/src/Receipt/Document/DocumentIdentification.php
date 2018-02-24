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
     * @return DocumentIdentification
     */
    public static function create($typeVersion, $type, $identifier, $multipleType, $creationDate) {
        $identification = new DocumentIdentification();
        $identification->setStandard("GS1");
        $identification->setTypeVersion($typeVersion);
        $identification->setType($type);
        $identification->setInstanceIdentifier($identifier);
        $identification->setMultipleType($multipleType);
        $identification->setCreationDateAndTime($creationDate);
        return $identification;
    }

    /**
     * @param string $standard
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;
    }

    /**
     * @return string
     */
    public function getStandard()
    {
        return $this->standard;
    }

    /**
     * @param string $typeVersion
     */
    public function setTypeVersion($typeVersion)
    {
        $this->typeVersion = $typeVersion;
    }

    /**
     * @return string
     */
    public function getTypeVersion()
    {
        return $this->typeVersion;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $instanceIdentifier
     */
    public function setInstanceIdentifier($instanceIdentifier)
    {
        $this->instanceIdentifier = $instanceIdentifier;
    }

    /**
     * @return string
     */
    public function getInstanceIdentifier()
    {
        return $this->instanceIdentifier;
    }

    /**
     * @param string $multipleType
     */
    public function setMultipleType($multipleType)
    {
        $this->multipleType = $multipleType;
    }

    /**
     * @return string
     */
    public function getMultipleType()
    {
        return $this->multipleType;
    }

    /**
     * @param \DateTime $creationDateAndTime
     */
    public function setCreationDateAndTime($creationDateAndTime)
    {
        $this->creationDateAndTime = $creationDateAndTime;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDateAndTime()
    {
        return $this->creationDateAndTime;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->standard = $this->standard;
        $ret->typeVersion = $this->typeVersion;
        $ret->type = $this->type;
        $ret->instanceIdentifier = $this->instanceIdentifier;
        $ret->multipleType = $this->multipleType;
        $ret->creationDateAndTime = $this->creationDateAndTime->format("Y-m-d\TH:i:sO");
        return \Utils::removeNullProperties($ret);
    }
}