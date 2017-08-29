<?php

/* 
 * Created by Cdiscount
 * Date : 18/05/2017
 * Time : 12:32
 */

namespace Sdk\Fulfilment;
use Sdk\Common\CommonResult;

class SubmitOfferStateActionResult extends CommonResult
{ 
    /*
     * SubmitOfferStateActionResult constructor, initialize array erorList the commonResult
     */
    public function __construct() 
    {
        $this->_errorList = array();
    }
}
