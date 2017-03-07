<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 15:11
 */

namespace Sdk\Order\Refund;
use Sdk\Common\CommonResult;

class SellerRefundResult extends CommonResult
{
    /*
     * @var string
     */
    private $_sellerProductId = null;
    
    /*
     * @var string
     */
    private $_ean = null;
    
    /*
     * @var enum
     */
    private $_motive = null;
    
    /*
     * @var decimal
     */
    private $_value = null;
    
    /*
     * SellerRefundResult constructor to initialize the errorList array of the commonResult
     */
    public function __construct() 
    {
        $this->_errorList = array();
    }

    /*
     * @return string
     */
    public function getSellerProductIdResult()
    {
        return $this->_sellerProductId;
    }
    
    /*
     * @param $sellerProductId
     */
    public function setSellerProductIdResult($sellerProductId)
    {
        $this->_sellerProductId = $sellerProductId;
    }
    
    /*
     * @return string
     */
    public function getEanResult()
    {
        return $this->_ean;
    }
    
    /*
     * @param $ean
     */
    public function setEanResult($ean)
    {
        $this->_ean = $ean;
    }
    
    /*
     * @var enum
     */
    public function getMotiveResult()
    {
        return $this->_motive;
    }
    
    /*
     * @param $motive
     */
    public function setMotiveResult($motive)
    {
        $this->_motive = $motive;
    }
    
    /*
     * @return decima
     */
    public function getValueResult()
    {
        return $this->_value;
    }
    
    /*
     * @param $value
     */
    public function setValueResult($value)
    {
        $this->_value = $value;
    }
}