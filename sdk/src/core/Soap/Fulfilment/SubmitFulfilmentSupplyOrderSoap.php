<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class SubmitFulfilmentSupplyOrderSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_fulfilmentSupplyOrderRequestTag = 'request';
    
    /*
     * @var string
     */
    private $_productListTAG = 'ProductList';

    /*
     * @var string
     */
    private $_fulfilmentProductDescriptionTAG = 'FulfilmentProductDescription';

     /*
     * @var string
     */
    private $_productEanTAG = 'ProductEan';

     /*
     * @var string
     */
    private $_quantityTAG = 'Quantity';

     /*
     * @var string
     */
    private $_extSupplyOrderIDTAG = 'ExtSupplyOrderID';

     /*
     * @var string
     */
    private $_wareHouseReceptionMinDateTAG = 'WareHouseReceptionMinDate';

     /*
     * @var string
     */
    private $_sellerProductReferenceTAG = 'SellerProductReference';

    /*
     * @var enum
     */
    private $_warehouseTAG = 'Warehouse';
    
    
  
   /*
    * SubmitFulfilmentSupplyOrderSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'SubmitFulfilmentSupplyOrder';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Fulfilment\FulfilmentSupplyOrderRequest
     * @return $xml
     */
    public function generateFulfilmentSupplyOrderRequestXml($request)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        /*
         * Opening tag FulfilmentSupplyOrderRequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_fulfilmentSupplyOrderRequestTag);
       
        if($request->getProductList() != null)
        {
            /*
            * Opening tag ProductList
            */
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_productListTAG);
            /** @var \Sdk\Fulfilment\FulfilmentProductDescription $fulfilmentProductDescription */
            foreach($request->getProductList() as $fulfilmentProductDescription)
            {
                $xml .= $this->_xmlUtil->generateOpenBalise($this->_fulfilmentProductDescriptionTAG);
                
                if($fulfilmentProductDescription->getExtSupplyOrderID() != null)
                {
                    //Tag ExtSupplyOrderID
                    $xml .= $this->_xmlUtil->generateBalise($this->_extSupplyOrderIDTAG, $fulfilmentProductDescription->getExtSupplyOrderID());
                }
                
                if($fulfilmentProductDescription->getProductEan() != null)
                {
                    //Tag ProductEan
                    $xml .= $this->_xmlUtil->generateBalise($this->_productEanTAG, $fulfilmentProductDescription->getProductEan());
                }
                
                if($fulfilmentProductDescription->getQuantity() != null)
                {
                    //Tag Quantity
                    $xml .= $this->_xmlUtil->generateBalise($this->_quantityTAG, $fulfilmentProductDescription->getQuantity());
                }
                

                if($fulfilmentProductDescription->getSellerProductReference() != null)
                {
                    //Tag SellerProductReference
                    $xml .= $this->_xmlUtil->generateBalise($this->_sellerProductReferenceTAG, $fulfilmentProductDescription->getSellerProductReference());
                }
                
                if($fulfilmentProductDescription->getWarehouseReceptionMinDate() != null)
                {
                    //Tag WareHouseReceptionMinDate
                    $xml .= $this->_xmlUtil->generateBalise($this->_wareHouseReceptionMinDateTAG, $fulfilmentProductDescription->getWarehouseReceptionMinDate());
                }

                if($fulfilmentProductDescription->getWarehouse() != null)
                {
                    //Tag Warehouse
                    $xml .= $this->_xmlUtil->generateBalise($this->_warehouseTAG, $fulfilmentProductDescription->getWarehouse());
                }

                //Tag fermante fulfilmentProductDescription
                $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentProductDescriptionTAG);
            }
            //Closing tag ProductList
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_productListTAG);
        }
     
        //Closing tag fulfilmentSupplyOrderRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentSupplyOrderRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');
        
        return $xml;
    }
}

