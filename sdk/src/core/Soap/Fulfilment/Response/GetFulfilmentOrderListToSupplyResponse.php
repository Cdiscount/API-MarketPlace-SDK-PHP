<?php
/**
 * Created by Driss kelmous
 * Date: 17/10/2016
 * Time: 13:27
 */
 
namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Fulfilment\FulfilmentOrderListToSupplyResult;
use \Sdk\Fulfilment\FulfilmentOrderLine;
use \Sdk\Soap\Common\SoapTools;

class GetFulfilmentOrderListToSupplyResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

   // @var FulfilmentOrderListToSupplyResult
    private $_fulfilmentOrderListToSupplyResult;
  
    /*
    * @return \Sdk\Fulfilment\FulfilmentOrderListToSupplyResult
    */
    public function getFulfilmentOrderListToSupplyResult()
    {
        return $this->_fulfilmentOrderListToSupplyResult;
    }

    /*
     * GetFulfilmentOrderListToSupplyResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
       $reader = new \Zend\Config\Reader\Xml();
       $this->_dataResponse = $reader->fromString($response);
       $this->_errorList = array();
        if(isset($this->_dataResponse['s:Body']['GetFulfilmentOrderListToSupplyResponse']['GetFulfilmentOrderListToSupplyResult']))
        {
            // Check For error message
            $this->_operationSuccess =  $this->isOperationSuccess($this->_dataResponse['s:Body']['GetFulfilmentOrderListToSupplyResponse']['GetFulfilmentOrderListToSupplyResult']);
            if ($this->_operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->getFulfilmentOrderList();
            }
        }
    }
    
    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetFulfilmentOrderListToSupplyResponse']['GetFulfilmentOrderListToSupplyResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the XML response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetFulfilmentOrderListToSupplyResponse']['GetFulfilmentOrderListToSupplyResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

     /*
     * Fill the array _fulfilmentOrderLineList from XML response
     */
     
    private function getFulfilmentOrderList()
    {
        $GetFulfilmentOrderListToSupplyResult = $this->_dataResponse['s:Body']['GetFulfilmentOrderListToSupplyResponse']['GetFulfilmentOrderListToSupplyResult'];
        
        $this->_fulfilmentOrderListToSupplyResult = new FulfilmentOrderListToSupplyResult();

	     //errorMessage and errorList
        if (isset($GetFulfilmentOrderListToSupplyResult['ErrorMessage']['_']) && strlen($GetFulfilmentOrderListToSupplyResult['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($GetFulfilmentOrderListToSupplyResult['ErrorMessage']))
        {
            $this->_fulfilmentOrderListToSupplyResult->setErrorMessage($GetFulfilmentOrderListToSupplyResult['ErrorMessage']['_']);
            $this->_fulfilmentOrderListToSupplyResult->addErrorToList($GetFulfilmentOrderListToSupplyResult['ErrorMessage']['_']);
            array_push($this->_errorList, $GetFulfilmentOrderListToSupplyResult['ErrorMessage']['_']);
        }   
                
        //operation success
        if (isset($GetFulfilmentOrderListToSupplyResult['OperationSuccess']['_']) && $GetFulfilmentOrderListToSupplyResult['OperationSuccess']['_'] == 'true')
        {
            $this->_fulfilmentOrderListToSupplyResult->setOperationSuccess(true);
        }

        if(isset($GetFulfilmentOrderListToSupplyResult['OrderLineList']['FulfilmentOrderLine']))
        {
            $orderLines = $GetFulfilmentOrderListToSupplyResult['OrderLineList']['FulfilmentOrderLine'];
            
            if(isset($orderLines['OrderReference']))
            {
                $orderLines = array($orderLines);
            }
        }
        if(isset($orderLines))
        {
            foreach ($orderLines as $orderLine)
            {
            /*
            * NB : Do not add sellerLogin and token id in the class parcelActionResult
            * Reason why it already exists in the class manageParcelResult
            */   
                
                $fulfilmentOrderLine = new FulfilmentOrderLine();

                //errorMessage and errorList
                if (isset($orderLine['ErrorMessage']['_']) && strlen($orderLine['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($orderLine['ErrorMessage']))
                {
                    $fulfilmentOrderLine->setErrorMessage($orderLine['ErrorMessage']['_']);
                    $fulfilmentOrderLine->addErrorToList($orderLine['ErrorMessage']['_']);
					array_push($this->_errorList, $orderLine['ErrorMessage']['_']);
                }
				//operation success
				if (isset($orderLine['OperationSuccess']['_']) && $orderLine['OperationSuccess']['_'] == 'true')
				{
					$fulfilmentOrderLine->setOperationSuccess(true);
				}
				
                //Seller Product Reference
                if (isset($orderLine['SellerProductReference']) && !SoapTools::isSoapValueNull($orderLine['SellerProductReference']))
                {
                    $fulfilmentOrderLine->setSellerProductReference($orderLine['SellerProductReference']);
                } 

                //Quantity
                if (isset($orderLine['Quantity']) && !SoapTools::isSoapValueNull($orderLine['Quantity']))
                {
                    $fulfilmentOrderLine->setQuantity($orderLine['Quantity']);
                } 

                //Product Name
                if (isset($orderLine['ProductName']) && !SoapTools::isSoapValueNull($orderLine['ProductName']))
                {
                    $fulfilmentOrderLine->setProductName($orderLine['ProductName']);
                } 
                    
                //Product Ean
                if (isset($orderLine['ProductEan']) && !SoapTools::isSoapValueNull($orderLine['ProductEan']))
                {
                    $fulfilmentOrderLine->setProductEan($orderLine['ProductEan']);
                }         
                    
                //Order Reference
                if (isset($orderLine['OrderReference']) && !SoapTools::isSoapValueNull($orderLine['OrderReference']))
                {
                    $fulfilmentOrderLine->setOrderReference($orderLine['OrderReference']);
                } 

                //Order Date
                if (isset($orderLine['OrderDate']) && !SoapTools::isSoapValueNull($orderLine['OrderDate']))
                {
                    $fulfilmentOrderLine->setOrderDate($orderLine['OrderDate']);
                }  

                //Latest Warehouse Delivery Date
                if (isset($orderLine['LatestWarehouseDeliveryDate']) && !SoapTools::isSoapValueNull($orderLine['LatestWarehouseDeliveryDate']))
                {
                    $fulfilmentOrderLine->setLatestWarehouseDeliveryDate($orderLine['LatestWarehouseDeliveryDate']);
                } 

                //Expected Customer Delivery Min 
                if (isset($orderLine['ExpectedCustomerDeliveryMin']) && !SoapTools::isSoapValueNull($orderLine['ExpectedCustomerDeliveryMin']))
                {
                    $fulfilmentOrderLine->setExpectedCustomerDeliveryMin($orderLine['ExpectedCustomerDeliveryMin']);
                } 

                //Expected Customer Delivery Max
                if (isset($orderLine['ExpectedCustomerDeliveryMax']) && !SoapTools::isSoapValueNull($orderLine['ExpectedCustomerDeliveryMax']))
                {
                    $fulfilmentOrderLine->setExpectedCustomerDeliveryMax($orderLine['ExpectedCustomerDeliveryMax']);
                } 

                //Warehouse
                if (isset($orderLine['Warehouse']) && !SoapTools::isSoapValueNull($orderLine['Warehouse']))
                {
                    $fulfilmentOrderLine->setWarehouse($orderLine['Warehouse']);
                } 
                
                $this->_fulfilmentOrderListToSupplyResult->addFulfilmentOrderLine($fulfilmentOrderLine);
            }
        }
    }
   
 }
