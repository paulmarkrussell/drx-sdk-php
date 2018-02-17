<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 21:07
 */

namespace Dreceiptx\Client\Response;


use Dreceiptx\Receipt\Merchant\Merchant;

class MerchantResponse
{
    /**
     * @var Merchant $merchant
     */
    private $merchant;

    /**
     * @return Merchant
     */
    public function getMerchant()
    {
        return $this->merchant;
    }
}