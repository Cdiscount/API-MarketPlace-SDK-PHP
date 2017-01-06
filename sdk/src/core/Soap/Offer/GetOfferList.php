<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 16:09
 */

namespace Sdk\Soap\Offer;


use Sdk\Soap\BaliseTool;

class GetOfferList extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetOfferList';
        parent::__construct();
    }
}