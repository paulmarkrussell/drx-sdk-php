<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-19
 * Time: 06:28
 */

namespace Dreceiptx\Receipt\Common\Measurements;
require_once __DIR__."/Measurement.php";
require_once __DIR__."/../../../Utils/Utils.php";

class TradeItemMeasurements implements \JsonSerializable
{
    private $height;
    private $width;
    private $depth;
    private $diameter;
    private $netContent;

    /**
     * @param Measurement $height
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * @return Measurement
     */
    public function getHeight()
    {
        if($this->height == null) {
            $this->height = new Measurement();
        }
        return $this->height;
    }

    /**
     * @param Measurement $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @return Measurement
     */
    public function getWidth()
    {
        if($this->width == null) {
            $this->width = new Measurement();
        }

        return $this->width;
    }

    /**
     * @param Measurement $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @return Measurement
     */
    public function getDepth()
    {
        if($this->depth == null) {
            $this->depth = new Measurement();
        }
        return $this->depth;
    }

    /**
     * @param Measurement $diameter
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $diameter;
    }

    /**
     * @return Measurement
     */
    public function getDiameter()
    {
        if($this->diameter == null) {
            $this->diameter = new Measurement();
        }
        return $this->diameter;
    }

    /**
     * @param Measurement $netContent
     */
    public function setNetContent($netContent)
    {
        $this->netContent = $netContent;
    }

    /**
     * @return Measurement
     */
    public function getNetContent()
    {
        if($this->netContent == null) {
            $this->netContent = new Measurement();
        }

        return $this->netContent;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->height = $this->height;
        $ret->width = $this->width;
        $ret->depth = $this->depth;
        $ret->diameter = $this->diameter;
        $ret->netContent = $this->netContent;
        return \Utils::removeNullProperties($ret);
    }
}