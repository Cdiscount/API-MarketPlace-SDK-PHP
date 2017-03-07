<?php

/* 
 * Created by Cdiscount
 * Date : 18/01/2017
 * Time : 15:46
 */

namespace Sdk\Order;

class ParcelInfos
{
    /*
     * @var string
     */
    private $_parcelNumber = null;
    
    /*
     * @var string
     */
    private $_sku = null;
    
    /*
     * @var enum
     */
    private $_manageParcel = null;
    
    /*
     * @return string
     */
    public function getParcelNumber()
    {
        return $this->_parcelNumber;
    }
    
    /*
     * parcelInfos constructor
     * @param $parcelNumber
     */
    public function __construct($parcelNumber) 
    {
        $this-> _parcelNumber = $parcelNumber;
    }
    
    /*
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this-> _sku = $sku;
    }

    /*
     * @return string
     */
    public function  getSku()
    {
        return $this->_sku;
    }
    
    /*
     * @return enum
     */
    public function getManageParcel()
    {
        return $this->_manageParcel;
    }
    
    /*
     * @param $parcelActionsTypes Sdk\Order\ParcelActionsTypes
     */
    public function setManageParcel($parcelActionsTypes)
    {
        $this-> _manageParcel = $parcelActionsTypes;
    }
}
