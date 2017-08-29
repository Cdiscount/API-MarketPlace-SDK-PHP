<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class SubmitFulfilmentActivationRequest
{
    /*
     * @var array
     */
    private $_productActivationList = null;
    
    /*
     * @return array
     */
    public function getProductActivationList()
    {
        return $this->_productActivationList;
    }
    
    /*
     * @param productActivation
     */
    public function addProductActivationData($productActivation)
    {
        array_push($this->_productActivationList, $productActivation);
    }
    
    /*
     * SubmitFulfilmentActivationRequest constructor
     */
    public function __construct() 
    {
        $this->_productActivationList = array();
    }
}