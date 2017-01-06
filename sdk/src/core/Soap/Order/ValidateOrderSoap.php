<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 14:01
 */

namespace Sdk\Soap\Order;


use Sdk\Soap\XmlUtils;

class ValidateOrderSoap
{

    private $_tag = 'ValidateOrder';

    /**
     * @var \Sdk\Order\ValidateOrder
     */
    private $_validateOrder = null;

    private $_CarrierNameTAG = 'CarrierName';
    private $_OrderNumberTAG = 'OrderNumber';
    private $_OrderStateTAG = 'OrderState';
    private $_TrackingNumberTAG = 'TrackingNumber';
    private $_TrackingUrlTAG = 'TrackingUrl';

    public function __construct($validateOrder)
    {
        $this->_validateOrder = $validateOrder;
        $this->_xmlUtil = new XmlUtils('');
    }

    public function serialize()
    {
        $xml = $this->_xmlUtil->generateOpenBalise($this->_tag);

        // CarrierName
        $xml .= $this->_xmlUtil->generateBalise($this->_CarrierNameTAG, $this->_validateOrder->getCarrierName());

        // OrderLineList
        $orderLineListSoap = new OrderLineListSoap($this->_validateOrder->getOrderLineList());
        $xml .= $orderLineListSoap->serialize();

        // OrderNumber
        $xml .= $this->_xmlUtil->generateBalise($this->_OrderNumberTAG, $this->_validateOrder->getOrderNumber());

        // OrderState
        $xml .= $this->_xmlUtil->generateBalise($this->_OrderStateTAG, $this->_validateOrder->getOrderState());

        // TrackingNumber
        $xml .= $this->_xmlUtil->generateBalise($this->_TrackingNumberTAG, $this->_validateOrder->getTrackingNumber());

        // TrackingUrl
        $xml .= $this->_xmlUtil->generateBalise($this->_TrackingUrlTAG, $this->_validateOrder->getTrackingUrl());

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_tag);
        return $xml;
    }
}