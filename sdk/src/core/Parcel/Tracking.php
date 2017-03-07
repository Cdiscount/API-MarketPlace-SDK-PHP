<?php

/* 
 * Created by Cdiscount
 * Date : 25/01/2017
 * Time : 15:46
 */

namespace Sdk\Parcel;

class Tracking
{
    /*
     * @var int
     */
    private $_trackingId;
    
    /*
     * @return int
     */
    public function getTrackingId()
    {
        return $this->_trackingId;
    }
    
    /*
     * Tracking constructor
     * @param $trackingId
     */
    public function __construct($trackingId)
    {
        $this->_trackingId = $trackingId;
    }
    
    /*
     * @var string
     */
    private $_parcelNum = null;
    
    /*
     * @return string
     */
    public function getParcelNum()
    {
        return $this->_parcelNum;
    }
    
    /*
     * @param $parcelNum
     */
    public function setParcelNum($parcelNum)
    {
        $this->_parcelNum = $parcelNum;
    }
    
    /*
     * @var string
     */
    private $_justification = null;
    
    /*
     * @return string
     */
    public function getJustification()
    {
        return $this->_justification;
    }
    
    /*
     * @param $justification
     */
    public function setJustification($justification)
    {
        $this->_justification = $justification;
    }
    
    /*
     * @var date string format
     */
    private $_insertDate= null;
    
    /*
     * @return string date
     */
    public function getInsertDate()
    {
        return $this->_insertDate;
    }
    
    /*
     * @param $insertDate
     */
    public function setInsertDate($insertDate)
    {
        $this->_insertDate = $insertDate;
    }
}
