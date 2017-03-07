<?php

/*
 * Created by CDiscount
 * Date: 31/01/2017
 * Time: 15:13
 */

namespace Sdk\Order;

/**
 * class contains the object voucher list
 * @author mohammed.sajid
 */
class VoucherList 
{
    /*
     * @var array
     */
    private $_voucherList = null;
    
    /*
     * The voucher list constructor
     */
    public function __construct() 
    {
        $this->_voucherList = array();
    }
    
    /*
     * @return array
     */
    public function getVouchers()
    {
        return $this->_voucherList;
    }
    
    /*
     * @param $voucher \Sdk\Order\Voucher
     */
    public function addVoucherToList($voucher)
    {
        array_push($this->_voucherList, $voucher);
    }
}
