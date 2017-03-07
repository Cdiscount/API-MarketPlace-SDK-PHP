<?php

/*
 * Created by CDiscount
 * Date: 31/01/2017
 * Time: 15:13
 */

namespace Sdk\Order\Refund;

/**
 * class contains the Amount and Motive id to create commercial gesture
 * * @author mohammed.sajid
 */
class RefundInformation 
{
    /*
     * @var decimal
     */
    private $_amount;
    
    /*
     * @var int
     */
    private $_motiveId;
    
    /*
     * @return decimal
     */
    public function getAmount()
    {
        return $this->_amount;
    }
    
    /*
     * @param $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }
    
    /*
     * @return int
     */
    public function getMotiveId()
    {
        return $this->_motiveId;
    }
    
    /*
     * @param $motiveId
     */
    public function setMotiveId($motiveId)
    {
        $this->_motiveId = $motiveId;
    }
}
