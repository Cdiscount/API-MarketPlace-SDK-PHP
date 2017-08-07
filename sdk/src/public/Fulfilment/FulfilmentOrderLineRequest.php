<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class FulfilmentOrderLineRequest
{
    /*
     * @var string
     */
    private $_orderReference = null;
    
    /*
     * @var string
     */
    private $_productEan = null;
    
    /*
     * @return string
     */
    public function getOrderReference()
    {
        return $this->_orderReference;
    }
    
     /*
     * @return string
     */
    public function  getProductEan()
    {
        return $this->_productEan;
    }

    /*
     * FulfilmentOrderLineRequest constructor
     * @param $OrderReference
     * @param $ProductEan
     */
    public function __construct($orderReference, $productEan) 
    {
        $this-> _orderReference = $orderReference;
        $this-> _productEan = $productEan;
    } 
}
