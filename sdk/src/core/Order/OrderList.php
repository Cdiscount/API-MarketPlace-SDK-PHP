<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 16:53
 */

namespace Sdk\Order;


class OrderList
{

    /**
     * @var array Sdk\Order\Order
     */
    private $_orderList = array();

    public function __construct()
    {

    }

    /**
     * @param $order \Sdk\Order\Order
     */
    public function addOrder($order)
    {
        array_push($this->_orderList, $order);
    }

    public function getOrders()
    {
        return $this->_orderList;
    }

    /**
     * @param $orderNumber
     * @return null|Order
     */
    public function getOrderByNumber($orderNumber)
    {
        if (!isset($orderNumber)) {
            return null;
        }

        /** @var \Sdk\Order\Order $order */
        foreach ($this->_orderList as $order) {
            if ($order->getOrderNumber() == $orderNumber) {
                return $order;
            }
        }
        return null;
    }
}