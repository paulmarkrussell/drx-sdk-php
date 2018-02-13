<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-13
 * Time: 11:28
 */

namespace Dreceiptx\Config;

interface ConfigManager
{
    /**
     * @param string $key
     * @return string
     */
    public function getConfigValue($key);

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public function setConfigValue($key, $value);
    /**
     * @param string $key
     * @return boolean
     */
    public function exists($key);
}