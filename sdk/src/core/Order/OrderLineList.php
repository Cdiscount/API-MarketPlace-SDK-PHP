<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 18:12
 */

namespace Sdk\Order;


class OrderLineList
{

    /**
     * @var array \Sdk\Order\OrderLine
     */
    private $_orderLineList = array();

    /**
     * @param $orderLine \Sdk\Order\OrderLine
     */
    public function addOrderLine($orderLine)
    {
        array_push($this->_orderLineList, $orderLine);
    }

    /**
     * @return array \Sdk\Order\OrderLine
     */
    public function getOrderLines()
    {
        return $this->_orderLineList;
    }

    /**
     * Get an order line by ID
     *
     * @param $productId
     * @return null|OrderLine
     */
    public function getOrderLineByProductId($productId)
    {
        if (!isset($productId)) {
            return null;
        }

        /** @var \Sdk\Order\OrderLine $orderLine */
        foreach ($this->_orderLineList as $orderLine) {
            if ($orderLine->getProductId() == $productId) {
                return $orderLine;
            }
        }
        return null;
    }
}