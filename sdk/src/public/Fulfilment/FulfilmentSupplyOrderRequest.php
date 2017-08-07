<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class FulfilmentSupplyOrderRequest
{
    
    /*
     * @var array
     */
    private $_productList = null;
    
    /*
     * @return array
     */
    public function getProductList()
    {
        return $this->_productList;
    }

    /*
     * @param $productList \Sdk\Fulfilment\FulfilmentProductDescription
     */
    public function addProductList($productList)
    {
        array_push($this->_productList, $productList);
    }
    
    /*
     * FulfilmentSupplyOrderRequest constructor
     */
    public function __construct() 
    {
        $this->_productList = array();
    }
}


