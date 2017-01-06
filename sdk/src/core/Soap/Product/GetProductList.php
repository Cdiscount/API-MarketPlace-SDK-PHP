<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:11
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class GetProductList extends BaliseTool
{

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {

        $this->_xmlns = $xmlns;
        $this->_tag = 'GetProductList';
        parent::__construct();
    }
}