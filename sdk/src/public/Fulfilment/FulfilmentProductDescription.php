<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class FulfilmentProductDescription
{
    /*
     * @var string
     */
    private $_productEan = null;
    
    /*
     * @var enum
     */
    private $_warehouse = null;

    /*
     * @var int
     */
    private $_quantity = null;

    /*
     * @var string
     */
    private $_extSupplyOrderID = null;

    /*
     * @var string
     */
    private $_wareHouseReceptionMinDate = null;

    /*
     * @var string
     */
    private $_SellerProductReference = null;
    
    /*
     * @return string
     */
    public function getProductEan()
    {
        return $this->_productEan;
    }
    
    /*
     * @return string
     */
    public function  getQuantity()
    {
        return $this->_quantity;
    }

    /*
     * @return string
     */
    public function  getExtSupplyOrderID()
    {
        return $this->_extSupplyOrderID;
    }

    /*
     * @return string
     */
    public function  getWarehouseReceptionMinDate()
    {
        return $this->_wareHouseReceptionMinDate;
    }

    /*
     * @return string
     */
    public function  getSellerProductReference()
    {
        return $this->_sellerProductReference;
    }

    /*
     * @return enum
     */
    public function getWarehouse()
    {
        return $this->_warehouse;
    }
    
    /*
     * @param $parcelActionsTypes Sdk\Order\ParcelActionsTypes
     */
    public function setWarehouse($warehouseTypes)
    {
        $this->_warehouse = $warehouseTypes;
    }

    /*
     * FulfilmentProductDescription constructor
     * @param $extSupplyOrderID string
     * @param $productEan string
     * @param $quantity int
     * @param $sellerProductReference string
     * @param $wareHouseReceptionMinDate Date
     * @param $warehouse enum
     */
    public function __construct($extSupplyOrderID, $productEan, $quantity, $sellerProductReference, $wareHouseReceptionMinDate, $warehouse) 
    {
        $this->_productEan = $productEan;
        $this->_warehouse = $warehouse;
        $this->_quantity = $quantity;
        $this->_extSupplyOrderID = $extSupplyOrderID;
        $this->_wareHouseReceptionMinDate = $wareHouseReceptionMinDate;
        $this->_sellerProductReference = $sellerProductReference;
    }    
}
