<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 15:22
 */

namespace Sdk\Delivey;


use Sdk\Soap\Common\SoapTools;

class ShippingInformation
{
    /**
     * @var string
     */
    private $_additionalShippingCharges = null;

    /**
     * @return string
     */
    public function getAdditionalShippingCharges()
    {
        return $this->_additionalShippingCharges;
    }

    /**
     * @param string $additionalShippingCharges
     */
    public function setAdditionalShippingCharges($additionalShippingCharges)
    {
        if (!SoapTools::isSoapValueNull($additionalShippingCharges)) {
            $this->_additionalShippingCharges = $additionalShippingCharges;
        }
    }

    /**
     * @var int
     */
    private $_maxLeadTime = 0;

    /**
     * @return int
     */
    public function getMaxLeadTime()
    {
        return $this->_maxLeadTime;
    }

    /**
     * @param int $maxLeadTime
     */
    public function setMaxLeadTime($maxLeadTime)
    {
        if (!SoapTools::isSoapValueNull($maxLeadTime)) {
            $this->_maxLeadTime = $maxLeadTime;
        }
    }

    /**
     * @var int
     */
    private $_minLeadTime = 0;

    /**
     * @return int
     */
    public function getMinLeadTime()
    {
        return $this->_minLeadTime;
    }

    /**
     * @param int $minLeadTime
     */
    public function setMinLeadTime($minLeadTime)
    {
        if (!SoapTools::isSoapValueNull($minLeadTime)) {
            $this->_minLeadTime = $minLeadTime;
        }
    }

    /**
     * @var float
     */
    private $_shippingCharges = 0.0;

    /**
     * @return float
     */
    public function getShippingCharges()
    {
        return $this->_shippingCharges;
    }

    /**
     * @param float $shippingCharges
     */
    public function setShippingCharges($shippingCharges)
    {
        if (!SoapTools::isSoapValueNull($shippingCharges)) {
            $this->_shippingCharges = $shippingCharges;
        }
    }

    /**
     * @var \Sdk\Delivey\DeliveryMode
     */
    private $_deliveryMode = null;

    /**
     * @return DeliveryMode
     */
    public function getDeliveryMode()
    {
        return $this->_deliveryMode;
    }

    /**
     * @param DeliveryMode $deliveryMode
     */
    public function setDeliveryMode($deliveryMode)
    {
        $this->_deliveryMode = $deliveryMode;
    }
}