<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 10:59
 */

namespace Sdk\Soap\Relays;


use Sdk\Soap\BaliseTool;

class GetParcelShopList extends BaliseTool
{

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {

        $this->_xmlns = $xmlns;
        $this->_tag = 'GetParcelShopList';
        parent::__construct();
    }
}