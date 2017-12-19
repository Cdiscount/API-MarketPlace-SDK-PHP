<?php

/* 
 * Created by Zakaria Boukhris
 * Date : 19/01/2017
 * Time : 15:46
 */

 namespace Sdk\Fulfilment;
 use Sdk\Common\CommonResult;

 class SupplyOrder extends CommonResult
 {
     /*
      *@var string
      */
     private $_numCda = null;
     /*
      *@var string
      */
     private $_sellerSupplyOrderNumber = null;
     /*
      *@var string
      */
     private $_wareHouse = null;
     /*
      *@var date
      */
     private $_wareHouseReceptionMinDate = null;
     /*
      *@var string
      */
     private $_productEAN = null;
     /*
      *@var string
      */
     private $_sellerProductReference = null;
     /*
      *@var int
      */
     private $_receivedQuantity = null;
     /*
      *@var string
      */
     private $_status = null;
     /*
      *@var string
      */
     private $_orderReferenceList = array();
     /*
      *@var bool
      */
     private $_isFod = null;
     /*
      *@var int
      */
     private $_undeliveredQuantity = null;
     
    /*
    * @var int
    */
    private $_orderedQuantity= null;

     public function __construct() 
     {
        $this->_errorList = array();
     }

     /*
     * @param $_supplyOrderNumber
     */
    public function setSupplyOrderNumber($supplyOrderNumber) 
    {
        $this->_numCda = $supplyOrderNumber;
    }

    /*
     * @return string
     */
    public function getSupplyOrderNumber()
    {
        return $this->_numCda;
    }

    /*
     * @param $_wareHouse  
     */
    public function setWareHouse($wareHouse) 
    {
        $this->_wareHouse = $wareHouse;
    }

    /*
     * @return string
     */
    public function getWareHouse()
    {
        return $this->_wareHouse;
    }

    /*
     * @param $_undeliveredQuantity  
     */
    public function setUndeliveredQuantity($undeliveredQuantity) 
    {
        $this->_undeliveredQuantity = $undeliveredQuantity;
    }

    /*
     * @return string
     */
    public function getUndeliveredQuantity()
    {
        return $this->_undeliveredQuantity;
    }

    /*
     * @param $_wareHouseReceptionMinDate   
     */
    public function setWareHouseReceptionMinDate($wareHouseReceptionMinDate) 
    {
        $this->_wareHouseReceptionMinDate = $wareHouseReceptionMinDate;
    }

    /*
     * @return string
     */
    public function getWareHouseReceptionMinDate()
    {
        return $this->_wareHouseReceptionMinDate;
    }

    /*
     * @param $_productEAN    
     */
    public function setProductEAN($productEAN) 
    {
        $this->_productEAN = $productEAN;
    }

    /*
     * @return string
     */
    public function getProductEAN()
    {
        return $this->_productEAN;
    }

    /*
     * @param $_sellerProductReference     
     */
    public function setSellerProductReference($sellerProductReference) 
    {
        $this->_sellerProductReference = $sellerProductReference;
    }

    /*
     * @return string
     */
    public function getSellerSupplyOrderNumber()
    {
        return $this->_sellerSupplyOrderNumber;
    }

    /*
     * @param $sellerSupplyOrderNumber     
     */
    public function setSellerSupplyOrderNumber($sellerSupplyOrderNumber) 
    {
        $this->_sellerSupplyOrderNumber = $sellerSupplyOrderNumber;
    }

    /*
     * @return string
     */
    public function getSellerProductReference()
    {
        return $this->_sellerProductReference;
    }

    /*
     * @param $_receivedQuantity     
     */
    public function setReceivedQuantity($receivedQuantity) 
    {
        $this->_receivedQuantity = $receivedQuantity;
    }

    /*
     * @return string
     */
    public function getReceivedQuantity()
    {
        return $this->_receivedQuantity;
    }

    /*
     * @param $_status      
     */
    public function setStatus($status) 
    {
        $this->_status = $status;
    }

    /*
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /*
     * @param $_orderReference       
     */
    public function addOrderReferenceToToArray($_orderReference)
    {
        array_push($this->_orderReferenceList, $_orderReference);
    }

    /*
     * @return string
     */
    public function getOrderReferenceList()
    {
        return $this->_orderReferenceList;
    }

    /*
     * @param $_isFod       
     */
    public function setIsFod($_isFod) 
    {
        $this->_isFod = $_isFod;
    }

    /*
     * @return string
     */
    public function getIsFod()
    {
        return $this->_isFod;
    }

    /*
    * return $_orderedQuantity
    */              
    public function getOrderedQuantity()
    {
        return $this->_orderedQuantity;
    }

    /*
     * @param $orderedQuantity
     */
    public function setOrderedQuantity($orderedQuantity)
    {
        $this->_orderedQuantity = $orderedQuantity;
    }
 } 