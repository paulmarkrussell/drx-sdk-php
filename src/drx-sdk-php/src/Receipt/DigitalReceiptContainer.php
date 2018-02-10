<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:16
 */

namespace Dreceiptx\Receipt;

require_once __DIR__.'/../../vendor/autoload.php';
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

    /**
     * @param $json S row object containing receipt data
     * @return DigitalReceiptContainer
     * @throws \JsonMapper_Exception
     */
    public static function fromJson($json)
    {
        $mapper = new \JsonMapper();
        $receipt = $mapper->map($json, new DigitalReceiptContainer());
        return $receipt;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->dRxDigitalReceipt = $this->dRxDigitalReceipt;
        return \Utils::removeNullProperties($ret);
    }
}