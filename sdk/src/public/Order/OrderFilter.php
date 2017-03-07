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
    
    /*
     * @var boolean
     */
    private $_fetchParcels = false;
    
    /*
     * @return boolean
     */
    public function isFetchParcels()
    {
        return $this->_fetchParcels;
    }
    
    /*
     * @param $fetchParcel
     */
    public function setFetchParcels($fetchParcel)
    {
        $this->_fetchParcels = $fetchParcel;
    }
    
    /*
     * @var string
     */
    private $_orderType = OrderTypeEnum::None;
    
    /*
     * @return string
     */
    public function getOrderType()
    {
        return $this->_orderType;
    }
    
    /*
     * @param $orderType
     */
    public function setOrderType($orderType)
    {
        $this->_orderType = $orderType;
    }
    
    /*
     * @var string
     */
    private $_partnerOrderRef = null;
    
    /*
     * @return string
     */
    public function getPartnerOrderRef()
    {
        return $this->_partnerOrderRef;
    }
    
    /*
     * @param $partnerOrderRef
     */
    public function setPartnerOrderRef($partnerOrderRef)
    {
        $this->_partnerOrderRef = $partnerOrderRef;
    }
    
    /*
     * order filter constructor
     */
    public function __construct() {
        $this->_orderReferenceList = array();
    }


    /*
     * @var array
     */
    private $_orderReferenceList = null;
    
    /*
     * @return array
     */
    public function getOrderReferenceList()
    {
        return $this->_orderReferenceList;
    }
    
    /*
     * @param $orderReference
     */
    public function addOrderReferenceToList($orderReference)
    {
        array_push($this->_orderReferenceList, $orderReference);
    }
}