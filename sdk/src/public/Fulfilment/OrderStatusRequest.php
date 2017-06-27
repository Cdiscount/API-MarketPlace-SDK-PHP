<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 27/04/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

/**
 * Order Status Request
 */
class OrderStatusRequest
{
    public function __construct() {
        $_valueList = array();
    }

    /*
     * @var String
     */
    private $_corporation = null;
    
    /*
     * @return string
     */
    public function getCorporation()
    {
        return $this->_corporation;
    }
    
    /*
     * @param $corporation
     */
    public function setCorporation($corporation)
    {
        $this->_corporation = $corporation;
    }   
    
    /*
     * @var String
     */
    private $_customerOrderNumber = null;
    
    /*
     * @return string
     */
    public function getCustomerOrderNumber()
    {
        return $this->_customerOrderNumber;
    }
    
    /*
     * @param $customerOrderNumber
     */
    public function setCustomerOrderNumber($customerOrderNumber)
    {
        $this->_customerOrderNumber = $customerOrderNumber;
    }    

}