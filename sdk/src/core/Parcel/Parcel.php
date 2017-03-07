<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/10/2016
 * Time: 13:29
 */

namespace Sdk\Parcel;


class Parcel
{
    /**
     * @var string
     */
    private $_customerNum = null;

    /**
     * @return string
     */
    public function getCustomerNum()
    {
        return $this->_customerNum;
    }

    /**
     * @param string $customerNum
     */
    public function setCustomerNum($customerNum)
    {
        $this->_customerNum = $customerNum;
    }

    /**
     * @var string
     */
    private $_externalCarrierName = null;

    /**
     * @return string
     */
    public function getExternalCarrierName()
    {
        return $this->_externalCarrierName;
    }

    /**
     * @param string $externalCarrierName
     */
    public function setExternalCarrierName($externalCarrierName)
    {
        $this->_externalCarrierName = $externalCarrierName;
    }

    /**
     * @var string
     */
    private $_externalCarrierTrackingUrl = null;

    /**
     * @return string
     */
    public function getExternalCarrierTrackingUrl()
    {
        return $this->_externalCarrierTrackingUrl;
    }

    /**
     * @param string $externalCarrierTrackingUrl
     */
    public function setExternalCarrierTrackingUrl($externalCarrierTrackingUrl)
    {
        $this->_externalCarrierTrackingUrl = $externalCarrierTrackingUrl;
    }

    /**
     * @var bool
     */
    private $_customerReturn = false;

    /**
     * @return boolean
     */
    public function isCustomerReturn()
    {
        return $this->_customerReturn;
    }

    /**
     * @param boolean $customerReturn
     */
    public function setCustomerReturn($customerReturn)
    {
        $this->_customerReturn = $customerReturn;
    }

    /**
     * @var String
     */
    private $_parcelStatus = null;

    /**
     * @return String
     */
    public function getParcelStatus()
    {
        return $this->_parcelStatus;
    }

    /**
     * @param String $parcelStatus
     */
    public function setParcelStatus($parcelStatus)
    {
        $this->_parcelStatus = $parcelStatus;
    }

    /**
     * @var string
     */
    private $_realCarrierCode = null;

    /**
     * @return string
     */
    public function getRealCarrierCode()
    {
        return $this->_realCarrierCode;
    }

    /**
     * @param string $realCarrierCode
     */
    public function setRealCarrierCode($realCarrierCode)
    {
        $this->_realCarrierCode = $realCarrierCode;
    }

    /**
     * @var \Sdk\Parcel\ParcelItemList
     */
    private $_parcelItemList = null;

    /**
     * @return ParcelItemList
     */
    public function getParcelItemList()
    {
        return $this->_parcelItemList;
    }

    public function __construct()
    {
        $this->_parcelItemList = new ParcelItemList();
    }
    
    /*
     * @var array
     */
    private $_trackingList = null;
    
    /*
     * @return array of \Sdk\Parcel\Tracking
     */
    public function getTrackingList()
    {
        return $this->_trackingList;
    }
    
    /*
     * @var $trackingList \Sdk\Parcel\TrackingList
     */
    public function setTrackingList($trackingList)
    {
        $this->_trackingList = $trackingList;
    }
}