<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 09:09
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class GetBrandList extends BaliseTool
{

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetBrandList';
        parent::__construct();
    }
}