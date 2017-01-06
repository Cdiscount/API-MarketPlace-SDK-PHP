<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 11/10/2016
 * Time: 09:57
 */

namespace Sdk\Order;


use Sdk\Common\Filter;

class OrderFilter extends Filter
{
    private $_fetchOrderLines = false;

    /**
     * @return boolean
     */
    public function isFetchOrderLines()
    {
        return $this->_fetchOrderLines;
    }

    /**
     * @param boolean $fetchOrderLines
     */
    public function setFetchOrderLines($fetchOrderLines)
    {
        $this->_fetchOrderLines = $fetchOrderLines;
    }

    private $_states = array();

    /**
     * @return array
     */
    public function getStates()
    {
        return $this->_states;
    }

    /**
     * @param $state
     */
    public function addState($state)
    {
        array_push($this->_states, $state);
    }
}