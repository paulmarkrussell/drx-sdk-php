<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-14
 * Time: 07:44
 */

namespace Dreceiptx\Users;


class ConfigOption implements \JsonSerializable
{
    /** @var string $option */
    private $option;

    /** @var string $value */
    private $value;

    public function __construct($option, $value)
    {
        $this->option = $option;
        $this->value = $value;
    }

    /**
     * @param string $option
     */
    public function setOption($option)
    {
        $this->option = $option;
    }

    /**
     * @return string
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->option = $this->option;
        $ret->value = $this->value;
        return \Utils::removeNullProperties($ret);
    }
}