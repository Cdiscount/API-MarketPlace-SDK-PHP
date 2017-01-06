<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 13:27
 */

namespace Sdk\Soap\Order;


use Sdk\Soap\BaliseTool;


class ValidateOrderList extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'ValidateOrderList';
        parent::__construct();
    }
}