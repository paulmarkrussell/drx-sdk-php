<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-13
 * Time: 11:28
 */

namespace Dreceiptx\Config;

require_once __DIR__."/ConfigManager.php";

class FileBasedConfigManager implements ConfigManager
{

    private $filePath;

    public function __construct($filePath) {
        if($filePath == null) {
            $this->filePath = __DIR__."/../../resources/config/drx.properties";
        } else {
            $this->filePath = $filePath;
        }
        if(file_exists($this->filePath)) {
            $this->readFile();
        }
    }

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
        $this->writeFile();
    }

    /**
     * @param string $key
     * @return boolean
     */
    public function exists($key) {
        return array_key_exists($key, $this->configuration);
    }

    private function writeFile() {
        $file = fopen($this->filePath, 'w');
        foreach ($this->configuration as $key => $value)
        {
            fwrite($file, $key ."=".$value."\n");
        }
        fclose($file);
    }

    private function readFile() {
        $handle = fopen($this->filePath, "r");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $parts = explode("=", $line);
                if(count($parts) == 2) {
                    $this->configuration[trim($parts[0])] = trim($parts[1]);
                }
            }
            fclose($handle);
        } else {
            throw new \Exception("Error reading file ".$this->filePath);
        }
    }
}