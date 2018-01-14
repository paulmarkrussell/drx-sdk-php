<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:16
 */

namespace Dreceiptx\Receipt;

require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__ . '/Document/StandardBusinessDocumentHeader.php';

class DRxDigitalReceipt implements \JsonSerializable
{
    private $standardBusinessDocumentHeader;

    public function setStandardBusinessDocumentHeader(Document\StandardBusinessDocumentHeader $standardBusinessDocumentHeader)
    {
        $this->standardBusinessDocumentHeader = $standardBusinessDocumentHeader;
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
        $ret -> standardBusinessDocumentHeader = $this->standardBusinessDocumentHeader;
        return $ret;
    }
}