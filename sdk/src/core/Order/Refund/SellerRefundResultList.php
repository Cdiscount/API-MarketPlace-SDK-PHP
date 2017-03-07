<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 15:11
 */

namespace Sdk\Order\Refund;


class SellerRefundResultList
{
    /*
     *@var array 
     */
    private $_sellerRefundResultList = null;
    
    /*
     * SellerRefundResultList constructor
     */
    public function __construct() 
    {
        $this->_sellerRefundResultList = array();
    }
    
    /*
     * @return array
     */
    public function getSellerRefundResultList()
    {
        return $this->_sellerRefundResultList;
    }

    /*
     * @param $sellerRefundResult Sdk\Order\Refund\SellerRefundResult
     */
    public function addSellerRefundResultToList($sellerRefundResult)
    {
        array_push($this->_sellerRefundResultList, $sellerRefundResult);
    }
}