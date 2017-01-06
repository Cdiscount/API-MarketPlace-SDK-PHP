<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 17:11
 */

namespace Sdk\Soap\Offer;


class GetOfferListPaginated extends GetOfferList
{

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        parent::__construct();
        $this->_tag = 'GetOfferListPaginated';
    }

}