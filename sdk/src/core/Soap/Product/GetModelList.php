<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 11:37
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class GetModelList extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetModelList';
        parent::__construct();
    }
}