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
require_once __DIR__."/../../Utils/Utils.php";

class LocationInformation implements \JsonSerializable
{
    private $address;
    private $contacts;

    /**
     * @param Address $address
     * @param Contact[] $contacts
     * @return LocationInformation
     */
    public static function create($address, $contacts) {
        $location = new LocationInformation();
        $location->address = $address;
        $location->contacts = $contacts;
        return $location;
    }
    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return Address
     */
    public function getAddressNotNull()
    {
        if ($this->address == null) {
            $this->address = new Address();
        }
        return $this->address;
    }

    /**
     * @param Contact[] $contacts
     */
    public function setContacts(array $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return Contact[]
     */
    public function getContacts()
    {
        if ($this->contacts == null) {
            $this->contacts = array();
        }
        return $this->contacts;
    }

    public function addContact($contact) {
        if ($this->contacts == null) {
            $this->contacts = array();
        }
        array_push($this->contacts, $contact);
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->address = $this->address;
        $ret->contacts = $this->contacts;
        return \Utils::removeNullProperties($ret);
    }
}