<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-01-14
 * Time: 09:22
 */

namespace Dreceiptx\Receipt;


class DigitalReceiptBuilder
{
    private $receipt;

    public function __construct()
    {
        $this->receipt = new DRxDigitalReceipt();
    }

    public function build()
    {
        $container = new DigitalReceiptContainer();
        $container->setDRxDigitalReceipt($this->receipt);
        return $container;
    }
}