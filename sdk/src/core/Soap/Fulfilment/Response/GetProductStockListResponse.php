<?php

/* 
 * Created by Cdiscount
 * Date : 26/04/2017
 * Time : 17:46
 */
namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Fulfilment\ProductStock;
use \Sdk\Fulfilment\ProductStockListMessage;
use \Sdk\Soap\Common\SoapTools;

class GetProductStockListResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_barCodeList = null;

    /**
     * @var string
     */
    private $_status = null;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @var string
     */
    private $_totalProductCount = null;

    /**
     * @return string
     */
    public function getTotalProductCount()
    {
        return $this->_totalProductCount;
    }

    /**
     * GetProductStockListResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();

        // Check For error message
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult']) && !$this->_hasErrorMessage())
        {
            $this->_setGlobalInformations();

            /**
             * Product List
             */
            $this->_barCodeList = array();
            $this->generateProductStockList();
        }
    }

    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
        $this->_status = $objInfoResult['a:Status'];
        $this->_totalProductCount = $objInfoResult['a:TotalProductCount'];
    }

    /**
     * Check if the XML response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

    /*
     * Fill the array ProductStockList from XML response
     */
    public function generateProductStockList()
    {
        $getProductStockListResult = $this->_dataResponse['s:Body']['GetProductStockListResponse']['GetProductStockListResult'];
        
	    /**
         * \sdk\src\core\Fulfilment\ProductStock
         */	
         if(isset($getProductStockListResult['a:ProductStockList']['a:ProductStock']))
         {
             $ProductStock = $getProductStockListResult['a:ProductStockList']['a:ProductStock'];

             if(isset($ProductStock['a:Ean']))
             {
                $ProductStock = array($ProductStock);
             }
         }
         // Vérifier l'existence de $ProductStock, si on ne rentre pas dans le isset précédent ca pète
        /**
         * \sdk\src\core\Fulfilment\ProductStock
         */	
		if(!empty($ProductStock)) 
		{
			foreach ($ProductStock as $productStockXml)
			{
			 /*
			  * NB : Do not add sellerLogin and token id in the class GetProductStockListResult
			  */   
				$productStock = new ProductStock();

				//Blocked Stock
				if (isset($productStockXml['a:BlockedStock']) && !SoapTools::isSoapValueNull($productStockXml['a:BlockedStock']))
				{				
					$productStock->setBlockedStock($productStockXml['a:BlockedStock']);
				}

				//Ean
				if (isset($productStockXml['a:Ean']) && !SoapTools::isSoapValueNull($productStockXml['a:Ean']))
				{
					$productStock->setEan($productStockXml['a:Ean']);
				}

				//Fod Stock
				if (isset($productStockXml['a:FodStock']) && !SoapTools::isSoapValueNull($productStockXml['a:FodStock']))
				{
					$productStock->setFodStock($productStockXml['a:FodStock']);
				} 

				//Front Stock
				if (isset($productStockXml['a:FrontStock']) && !SoapTools::isSoapValueNull($productStockXml['a:FrontStock']))
				{
					$productStock->setFrontStock($productStockXml['a:FrontStock']);
				} 

				//Is Referenced
				if (isset($productStockXml['a:IsReferenced']) && !SoapTools::isSoapValueNull($productStockXml['a:IsReferenced']) && $productStockXml['a:IsReferenced'] == 'true')
				{
					$productStock->setIsReferenced(true);
				} 

				//Libelle
				if (isset($productStockXml['a:Libelle']) && !SoapTools::isSoapValueNull($productStockXml['a:Libelle']))
				{
					$productStock->setLibelle($productStockXml['a:Libelle']);
				} 

				//SellerReference
				if (isset($productStockXml['a:SellerReference']) && !SoapTools::isSoapValueNull($productStockXml['a:SellerReference']))
				{
					$productStock->setSellerReference($productStockXml['a:SellerReference']);
				}

				//Sku
				if (isset($productStockXml['a:Sku']) && !SoapTools::isSoapValueNull($productStockXml['a:Sku']))
				{
					$productStock->setSku($productStockXml['a:Sku']);
				} 

				//Stock In Warehouse
				if (isset($productStockXml['a:StockInWarehouse']) && !SoapTools::isSoapValueNull($productStockXml['a:StockInWarehouse']))
				{
					$productStock->setStockInWarehouse($productStockXml['a:StockInWarehouse']);
				} 

				//Warehouse
				if (isset($productStockXml['a:Warehouse']) && !SoapTools::isSoapValueNull($productStockXml['a:Warehouse']))
				{
					$productStock->setWarehouse($productStockXml['a:Warehouse']);
				} 
				array_push($this->_barCodeList, $productStock);
			}
		}		
        
    }

    /**
     * @return array 
     */
    public function getProductStockList()
    {
        return $this->_barCodeList;
    }
 }
