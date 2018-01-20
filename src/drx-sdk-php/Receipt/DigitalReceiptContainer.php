<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:16
 */

namespace Dreceiptx\Receipt;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/DRxDigitalReceipt.php';
require_once __DIR__."/../Utils/Utils.php";

class DigitalReceiptContainer implements \JsonSerializable
{
    private $dRxDigitalReceipt;

    /**
    * @param DRxDigitalReceipt $dRxDigitalReceipt
    */
    public function setDRxDigitalReceipt($dRxDigitalReceipt)
    {
        $this->dRxDigitalReceipt = $dRxDigitalReceipt;
    }

    public static function fromJson($json)
    {
        $mapper = new \JsonMapper();
        $receipt = $mapper->map($json, new DigitalReceiptContainer());
        return $receipt;
    }

    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->dRxDigitalReceipt = $this->dRxDigitalReceipt;
        return \Utils::removeNullProperties($ret);
    }
}