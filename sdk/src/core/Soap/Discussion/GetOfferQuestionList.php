<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 17:49
 */

namespace Sdk\Soap\Discussion;


use Sdk\Soap\BaliseTool;

class GetOfferQuestionList extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetOfferQuestionList';
        parent::__construct();
    }
}