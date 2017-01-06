<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 14:17
 */

namespace Sdk\Order\Validate;


class ValidateOrderLineResults
{
    /**
     * @var array \Sdk\Order\Validate\ValidateOrderLineResult
     */
    private $_validateOrderLineResults = null;

    /**
     * @return array
     */
    public function getValidateOrderLineResults()
    {
        return $this->_validateOrderLineResults;
    }

    /**
     * ValidateOrderLineResults constructor.
     */
    public function __construct()
    {
        $this->_validateOrderLineResults = array();
    }

    /**
     * @param $orderLineResult \Sdk\Order\Validate\ValidateOrderLineResult
     */
    public function addValidateOrderLineResult($orderLineResult)
    {
       array_push($this->_validateOrderLineResults, $orderLineResult);
    }

}