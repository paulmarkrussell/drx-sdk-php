<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:51
 */

namespace Dreceiptx\Receipt\Common;
use Dreceiptx\Receipt\LineItem\TransactionalTradeItem;

require_once __DIR__."/SellerInformation.php";
require_once __DIR__."/DutyFeeTaxRegistration.php";
require_once __DIR__."/../../Utils/Utils.php";

class TransactionalParty implements \JsonSerializable
{

    private $organisationDetails;
    private $dutyFeeTaxRegistration;

    /**
     * @param string $organisationName
     * @param string $dutyFreeTaxTypeCode
     * @param string $dutyFeeTaxRegistationID
     * @return TransactionalParty
     */
    public static function create($organisationName, $dutyFreeTaxTypeCode, $dutyFeeTaxRegistationID) {
        $party = new TransactionalParty();
        $party->organisationDetails = SellerInformation::create($organisationName);
        $party->dutyFeeTaxRegistration = DutyFeeTaxRegistration::create($dutyFreeTaxTypeCode, $dutyFeeTaxRegistationID);
        return $party;
    }

    /**
     * @param SellerInformation $organisationDetails
     */
    public function setOrganisationDetails($organisationDetails)
    {
        $this->organisationDetails = $organisationDetails;
    }

    /**
     * @return SellerInformation
     */
    public function getOrganisationDetails()
    {
        return $this->organisationDetails;
    }

    /**
     * @param DutyFeeTaxRegistration $dutyFeeTaxRegistration
     */
    public function setDutyFeeTaxRegistration($dutyFeeTaxRegistration)
    {
        $this->dutyFeeTaxRegistration = $dutyFeeTaxRegistration;
    }

    /**
     * @return DutyFeeTaxRegistration
     */
    public function getDutyFeeTaxRegistration()
    {
        return $this->dutyFeeTaxRegistration;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->organisationDetails = $this->organisationDetails;
        $ret->dutyFeeTaxRegistration = $this->dutyFeeTaxRegistration;
        return \Utils::removeNullProperties($ret);
    }
}