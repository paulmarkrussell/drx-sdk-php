<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 16:05
 */

namespace Dreceiptx\Receipt\Document;
require_once __DIR__."/../../Utils/Utils.php";

class DocumentOwnerIdentification implements \JsonSerializable
{

    private $authority;
    private $value;

    /**
     * @param string $authority
     */
    public function setAuthority($authority)
    {
        $this->authority = $authority;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->authority = $this->authority;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}