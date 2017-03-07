<?php

/**
 * Created by CDiscount
 * Date: 01/02/2017
 * Time: 11:04
 */
namespace Sdk\Order\Refund;

/**
 * Class contains methods to get o set the commercial gesture list response
 * @author mohammed.sajid
 */
class CommercialGestureList 
{
    /*
     * @var array
     */
    private $_commercialGestureList = null;
    
    /*
     * Commercial gesture list constructor
     */
    public function __construct() 
    {
        $this->_commercialGestureList = array();
    }
    
    /*
     * @return array
     */
    public function getCommercialGestureResultList()
    {
        return $this->_commercialGestureList;
    }
    
    /*
     * @param $refundInformationMessage \Sdk\Order\Refund\RefundInformationMessage
     */
    public function addRefundInformationMessageToList($refundInformationMessage)
    {
        array_push($this->_commercialGestureList, $refundInformationMessage);
    }
}
