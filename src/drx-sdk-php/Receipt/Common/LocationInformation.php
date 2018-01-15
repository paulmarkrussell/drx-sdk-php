<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/Address.php";
require_once __DIR__."/Contact.php";

class LocationInformation implements \JsonSerializable
{
    private $address;
    private $contacts;

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param Contact[] $contacts
     */
    public function setContacts(array $contacts)
    {
        $this->contacts = $contacts;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->address = $this->address;
        $ret->contacts = $this->contacts;
        return $ret;
    }
}