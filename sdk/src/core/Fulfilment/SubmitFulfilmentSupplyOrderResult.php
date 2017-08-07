<?php

/* 
 * Created by Cdiscount
 * Date : 02/05/2017
 * Time : 12:34
 */

namespace Sdk\Fulfilment;
use Sdk\Common\CommonResult;

class SubmitFulfilmentSupplyOrderResult extends CommonResult
{
    /*
     * @var long
     */
    private $_depositId = null;
    
       
    /*
     * SubmitFulfilmentSupplyOrderResult constructor, initialize array erorList the commonResult
     */
    public function __construct() 
    {
        $this->_errorList = array();
    }

    /*
     * @param $depositId
     */
    public function setDepositId($depositId) 
    {
        $this->_depositId = $depositId;
    }

    /*
     * @return long
     */
    public function getDepositId()
    {
        return $this->_depositId;
    }
}
