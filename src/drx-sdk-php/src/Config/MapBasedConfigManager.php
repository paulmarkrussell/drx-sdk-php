<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-13
 * Time: 11:28
 */

namespace Dreceiptx\Config;

require_once __DIR__."/ConfigManager.php";

class MapBasedConfigManager implements ConfigManager
{

    private $configuration = array();
    /**
     * @param string $key
     * @return string
     */
    public function getConfigValue($key) {
        if ($this->exists($key)) {
            return $this->configuration[$key];
        }
        return null;
    }

    /**
     * @param string $key
     * @param string $value
     * @return string
     */
    public function setConfigValue($key, $value) {
        $this->configuration[$key] = $value;
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function exists($key) {
        return array_key_exists($key, $this->configuration);
    }
}