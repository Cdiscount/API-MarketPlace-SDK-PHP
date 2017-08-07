<?php

/* 
 * Created by Cdiscount
 * Date : 02/05/2017
 * Time : 12:34
 */

namespace Sdk\Fulfilment;
use Sdk\Common\CommonResult;

class FulfilmentOrderListToSupplyResult extends CommonResult
{
    /*
     * @var array
     */
    private $_fulfilmentOrderLineList = null;

    /*
     * @return array
     */
    public function getFulfilmentOrderLineList()
    {
        return $this->_fulfilmentOrderLineList;
    }
    /**
     * @param $fulfilmentOrderLine \Sdk\Fulfilment\SupplyOrder
     */
    public function addFulfilmentOrderLine($fulfilmentOrderLine)
    {
        array_push($this->_fulfilmentOrderLineList, $fulfilmentOrderLine);
    }
       
    /*
     * FulfilmentOrderListToSupplyResult constructor
     */
    public function __construct() 
    {
        $this->_fulfilmentOrderLineList  = array();
        $this->_errorList = array();

    }
}