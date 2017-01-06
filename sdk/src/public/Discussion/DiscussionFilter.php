<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 16:29
 */

namespace Sdk\Discussion;

use Sdk\Common\Filter;

class DiscussionFilter extends Filter
{
    /**
     * @var array
     */
    protected $_statusList = null;

    /**
     * @param $status
     */
    public function addStatus($status)
    {
        array_push($this->_statusList, $status);
    }

    /**
     * @return array
     */
    public function getStatusList()
    {
        return $this->_statusList;
    }

    /**
     * @var array
     */
    private $_orderNumberList = null;

    /**
     * @param $orderNumber
     */
    public function addOrderNumber($orderNumber)
    {
        if ($this->_orderNumberList == null) {
            $this->_orderNumberList = array();
        }
        array_push($this->_orderNumberList, $orderNumber);
    }

    /**
     * @return array
     */
    public function getOrderNumberList()
    {
        return $this->_orderNumberList;
    }

}