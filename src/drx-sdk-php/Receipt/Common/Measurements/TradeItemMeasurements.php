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
     * @param Measurement $width
     * @param Measurement $depth
     * @param Measurement $diameter
     * @param Measurement $netContent
     * @return TradeItemMeasurements
     */
    public static function create($height, $width, $depth, $diameter, $netContent) {
        $measurement = new TradeItemMeasurements();
        $measurement->height = $height;
        $measurement->width = $width;
        $measurement->depth = $depth;
        $measurement->diameter = $diameter;
        $measurement->netContent = $netContent;
        return $measurement;
    }

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