<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Settlement;
require_once __DIR__ . "/../../Utils/Utils.php";

class TransactionalReference implements \JsonSerializable
{

    private $transactionalReferenceTypeCode;
    private $entityIdentification;

    /**
     * @param string $code
     * @param string $id
     * @return TransactionalReference
     */
    public static function create($code, $id) {
        $ref = new TransactionalReference();
        $ref->transactionalReferenceTypeCode = $code;
        $ref->entityIdentification = $id;
        return $ref;
    }

    /**
     * @param string $transactionalReferenceTypeCode
     */
    public function setTransactionalReferenceTypeCode($transactionalReferenceTypeCode)
    {
        $this->transactionalReferenceTypeCode = $transactionalReferenceTypeCode;
    }

    /**
     * @return string
     */
    public function getTransactionalReferenceTypeCode()
    {
        return $this->transactionalReferenceTypeCode;
    }

    /**
     * @param string $entityIdentification
     */
    public function setEntityIdentification($entityIdentification)
    {
        $this->entityIdentification = $entityIdentification;
    }

    /**
     * @return string
     */
    public function getEntityIdentification()
    {
        return $this->entityIdentification;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->transactionalReferenceTypeCode = $this->transactionalReferenceTypeCode;
        $ret->entityIdentification = $this->entityIdentification;
        return \Utils::removeNullProperties($ret);
    }
}