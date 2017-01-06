<?php
/**
 * Created by Cdiscount.
 * Date: 13/12/2016
 * Time: 17:52
 */


namespace Sdk\Order;


use Sdk\Common\CommonResult;

class ParcelActionResult extends CommonResult
{
    /**
     * @var string
     */
    private $_actionType = null;

    /**
     * @return string
     */
    public function getActionType()
    {
        return $this->_actionType;
    }

    /**
     * @param string $actionType
     */
    public function setActionType($actionType)
    {
        $this->_actionType = $actionType;
    }

    /**
     * @var bool
     */
    private $_actionCreated = false;

    /**
     * @return boolean
     */
    public function isActionCreated()
    {
        return $this->_actionCreated;
    }

    /**
     * @param boolean $actionCreated
     */
    public function setActionCreated($actionCreated)
    {
        $this->_actionCreated = $actionCreated;
    }

    /**
     * @var string
     */
    private $_parcelNumber = null;

    /**
     * @return string
     */
    public function getParcelNumber()
    {
        return $this->_parcelNumber;
    }

    /**
     * @param string $parcelNumber
     */
    public function setParcelNumber($parcelNumber)
    {
        $this->_parcelNumber = $parcelNumber;
    }
}