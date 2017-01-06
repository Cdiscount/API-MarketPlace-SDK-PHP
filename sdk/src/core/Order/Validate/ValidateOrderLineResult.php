<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 14:17
 */

namespace Sdk\Order\Validate;


class ValidateOrderLineResult
{
    private $_errors = array();

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->_errors;
    }

    /**
     * @param $error string
     */
    public function addError($error)
    {
        array_push($this->_errors, $error);
    }

    /**
     * @var bool
     */
    private $_updated = false;

    /**
     * @return boolean
     */
    public function isUpdated()
    {
        return $this->_updated;
    }

    /**
     * @param boolean $updated
     */
    public function setUpdated($updated)
    {
        $this->_updated = $updated;
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
     * ValidateOrderLineResult constructor.
     * @param $sellerProductId
     */
    public function __construct($sellerProductId)
    {
        $this->_sellerProductId = $sellerProductId;
    }
}