<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-19
 * Time: 06:28
 */

namespace Dreceiptx\Receipt\Common\Measurements;
require_once __DIR__."/Measurement.php";

class TradeItemMeasurement implements \JsonSerializable
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
     * @param Measurement $width
     */
    public function setWidth($width)
    {
        $this->width = $width;
    }

    /**
     * @param Measurement $depth
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
    }

    /**
     * @param mixed $diameter
     */
    public function setDiameter($diameter)
    {
        $this->diameter = $diameter;
    }

    /**
     * @param mixed $netContent
     */
    public function setNetContent($netContent)
    {
        $this->netContent = $netContent;
    }

    public function jsonSerialize()
    {
        $ret = new \stdClass();
        $ret->height = $this->height;
        $ret->width = $this->width;
        $ret->depth = $this->depth;
        $ret->diameter = $this->diameter;
        return $ret;
    }
}