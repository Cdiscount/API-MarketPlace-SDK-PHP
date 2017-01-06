<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 13:18
 */

namespace Sdk\Order\Validate;

use Sdk\Order\Order;

class ValidateOrder extends Order
{

    /**
     * @var string
     */
    private $_carrierName = null;

    /**
     * @return string
     */
    public function getCarrierName()
    {
        return $this->_carrierName;
    }

    /**
     * @param string $carrierName
     */
    public function setCarrierName($carrierName)
    {
        $this->_carrierName = $carrierName;
    }

    /**
     * @var string
     */
    private $_trackingNumber = null;

    /**
     * @return string
     */
    public function getTrackingNumber()
    {
        return $this->_trackingNumber;
    }

    /**
     * @param string $trackingNumber
     */
    public function setTrackingNumber($trackingNumber)
    {
        $this->_trackingNumber = $trackingNumber;
    }

    /**
     * @var string
     */
    private $_trackingUrl = null;

    /**
     * @return string
     */
    public function getTrackingUrl()
    {
        return $this->_trackingUrl;
    }

    /**
     * @param string $trackingUrl
     */
    public function setTrackingUrl($trackingUrl)
    {
        $this->_trackingUrl = $trackingUrl;
    }

}