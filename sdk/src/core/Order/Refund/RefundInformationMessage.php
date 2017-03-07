<?php

/**
 * Created by CDiscount
 * Date: 01/02/2017
 * Time: 11:04
 */

namespace Sdk\Order\Refund;
use Sdk\Common\CommonResult;
/**
 * Class contains the motive and amount for commercial gesture response
 * @author mohammed.sajid
 */
class RefundInformationMessage extends CommonResult 
{
    /*
     * @var decimal
     */
    private $_amount = null;
    
    /*
     * @var int
     */
    private $_motiveId = null;
    
    /*
     * RefundInformationMessage constructor to initialize errorList array of the commonResult
     */
    public function __construct() 
    {
        $this->_errorList = array();
    }

    /*
     * @retunr decimal
     */
    public function getAmountResult()
    {
        return $this->_amount;
    }
    
    /*
     * @param $amount
     */
    public function setAmountResult($amount)
    {
        $this->_amount = $amount;
    }
    
    /*
     * @return int
     */
    public function getMotiveIdResult()
    {
        return $this->_motiveId;
    }
    
    /*
     * @param $motiveId
     */
    public function setMotiveIdResult($motiveId)
    {
        $this->_motiveId = $motiveId;
    }
}
