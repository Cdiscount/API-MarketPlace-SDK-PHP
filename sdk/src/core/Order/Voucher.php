<?php

/*
 * Created by CDiscount
 * Date: 31/01/2017
 * Time: 15:13
 */

namespace Sdk\Order;

/**
 * class contains the information about commercial gesture and refund source(Seller/CDS/Customer)
 *
 * @author mohammed.sajid
 */
class Voucher 
{
    /*
     * @var DateTime
     */
    private $_createDate = null;
    
    /*
     * @return DateTime
     */
    public function getCreateDate()
    {
        return $this->_createDate;
    }
    
    /*
     * @param $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->_createDate = $createDate;
    }
    
    /*
     * @var \Sdk\Order\Refund\RefundInformation
     */
    private $_refundInformation = null;
    
    /*
     * @return \Sdk\Order\Refund\RefundInformation
     */
    public function getRefundInformation()
    {
        return $this->_refundInformation;
    }
    
    /*
     * @param $refundInformation \Sdk\Order\Refund\RefundInformation
     */
    public function setRefundInformation($refundInformation)
    {
        $this->_refundInformation = $refundInformation;
    }
    
    /*
     * @var \Sdk\Order\VoucherSourceActorEnum
     */
    private $_source = null;
    
    /*
     * @return \Sdk\Order\VoucherSourceActorEnum
     */
    public function getSource()
    {
        return $this->_source;
    }
    
    /*
     * @param $source \Sdk\Order\VoucherSourceActorEnum
     */
    public function setSource($source)
    {
        $this->_source = $source;
    }
}
