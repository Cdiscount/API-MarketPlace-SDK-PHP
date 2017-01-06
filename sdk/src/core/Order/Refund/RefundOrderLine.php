<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 15:15
 */

namespace Sdk\Order\Refund;


class RefundOrderLine
{
    /**
     * @var string
     */
    private $_ean = null;

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->_ean;
    }

    /**
     * @var string
     */
    private $_sellerProductId = null;

    /**
     * @return string
     */
    public function getSellerProductId()
    {
        return $this->_sellerProductId;
    }

    /**
     * @var bool
     */
    private $_refundShippingCharges = false;

    /**
     * @return boolean
     */
    public function isRefundShippingCharges()
    {
        return $this->_refundShippingCharges;
    }

    /**
     * RefundOrderLine constructor.
     *
     * @param $ean
     * @param $sellerProductId
     * @param $refundShippingCharges
     */
    public function __construct($ean, $sellerProductId, $refundShippingCharges)
    {
        $this->_ean = $ean;
        $this->_sellerProductId = $sellerProductId;
        $this->_refundShippingCharges = $refundShippingCharges;
    }
}