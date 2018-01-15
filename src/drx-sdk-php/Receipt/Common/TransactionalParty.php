<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:51
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/SellerInformation.php";
require_once __DIR__."/DutyFeeTaxRegistration.php";

class TransactionalParty implements \JsonSerializable
{

    private $organisationDetails;
    private $dutyFeeTaxRegistration;

    /**
     * @param SellerInformation $organisationDetails
     */
    public function setOrganisationDetails($organisationDetails)
    {
        $this->organisationDetails = $organisationDetails;
    }

    /**
     * @param DutyFeeTaxRegistration $dutyFeeTaxRegistration
     */
    public function setDutyFeeTaxRegistration($dutyFeeTaxRegistration)
    {
        $this->dutyFeeTaxRegistration = $dutyFeeTaxRegistration;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->organisationDetails = $this->organisationDetails;
        $ret->dutyFeeTaxRegistration = $this->dutyFeeTaxRegistration;
        return $ret;
    }
}