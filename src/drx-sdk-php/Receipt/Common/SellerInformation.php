<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 19:21
 */

namespace Dreceiptx\Receipt\Common;
require_once __DIR__."/../../Utils/Utils.php";

class SellerInformation implements \JsonSerializable
{
    private $organisationName;

    /**
     * @param string $organisationName
     */
    public function setOrganisationName($organisationName)
    {
        $this->organisationName = $organisationName;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->organisationName = $this->organisationName;
        return \Utils::removeNullProperties($ret);
    }
}