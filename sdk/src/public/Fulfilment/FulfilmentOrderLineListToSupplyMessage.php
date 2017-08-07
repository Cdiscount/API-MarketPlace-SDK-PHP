<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 18:12
 */

namespace Sdk\Order;


class FulfilmentOrderLineListToSupplyMessage
{
    /**
     * @var array \Sdk\Fulfilment\FulfilmentOrderLine
     */
    private $_orderLineList = array();
    
    /**
     * @param $orderLine \Sdk\Fulfilment\FulfilmentOrderLine
     */
    public function addOrderLine($orderLine)
    {
        array_push($this->_orderLineList, $orderLine);
    }

    /**
     * @return array \Sdk\Fulfilment\FulfilmentOrderLine
     */
    public function getOrderLines()
    {
        return $this->_orderLineList;
    }
}