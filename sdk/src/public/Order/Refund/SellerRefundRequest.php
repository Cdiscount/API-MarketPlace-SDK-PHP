<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 15:11
 */

namespace Sdk\Order\Refund;


class SellerRefundRequest
{
    /**
     * @var string
     */
    private $_mode = null;

    /**
     * @return string
     */
    public function getMode()
    {
        return $this->_mode;
    }

    /**
     * @param string $mode
     */
    public function setMode($mode)
    {
        $this->_mode = $mode;
    }

    /**
     * @var string
     */
    private $_motive = null;

    /**
     * @return string
     */
    public function getMotive()
    {
        return $this->_motive;
    }

    /**
     * @param string $motive
     */
    public function setMotive($motive)
    {
        $this->_motive = $motive;
    }

    /**
     * @var \Sdk\Order\Refund\RefundOrderLine
     */
    private $_refundOrderLine = null;

    /**
     * @return RefundOrderLine
     */
    public function getRefundOrderLine()
    {
        return $this->_refundOrderLine;
    }

    /**
     * SellerRefundRequest constructor.
     * @param $refundOrderLine
     */
    public function __construct($refundOrderLine)
    {
        $this->_refundOrderLine = $refundOrderLine;
    }

}