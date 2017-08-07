<?php

/* 
 * Created by Zakaria Boukrhis
 * Date : 19/01/2017
 * Time : 15:46
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;

use Sdk\Fulfilment\FulfilmentSupplyOrderResult;
use Sdk\Fulfilment\SupplyOrderList;
use Sdk\Fulfilment\SupplyOrder;

class GetFulfilmentSupplyOrderResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;
    
    /*
     * @var FulfilmentSupplyOrderResult
     */
    private $_fulfilmentSupplyOrderResult= null;

    /*
    * @return \Sdk\Fulfilment\FulfilmentSupplyOrderResult
    */
    public function getFulfilmentSupplyOrderResult()
    {
        return $this->_fulfilmentSupplyOrderResult;
    }

    /*
     * GetFulfilmentSupplyOrderResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();

        if(isset($this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderResponse']['GetFulfilmentSupplyOrderResult']))
        {
            // Check For error message
            $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderResponse']['GetFulfilmentSupplyOrderResult']);
            if ($this->_operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->generateFulfilementSupplyOrderList();
            }
        }    
    }
    
    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderResponse']['GetFulfilmentSupplyOrderResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    
    /*
     * Fill the array _supplyOrderList from XML response
     */
    private function generateFulfilementSupplyOrderList()
    {
        $fulfilmentSupplyOrderResult = $this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderResponse']['GetFulfilmentSupplyOrderResult'];
        
        $this->_fulfilmentSupplyOrderResult = new FulfilmentSupplyOrderResult();

         //errorMessage and errorList
        if (isset($fulfilmentSupplyOrderResult['ErrorMessage']['_']) && strlen($fulfilmentSupplyOrderResult['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($fulfilmentSupplyOrderResult['ErrorMessage']))
        {
            $this->_fulfilmentSupplyOrderResult->setErrorMessage($fulfilmentSupplyOrderResult['ErrorMessage']['_']);
            $this->_fulfilmentSupplyOrderResult->addErrorToList($fulfilmentSupplyOrderResult['ErrorMessage']['_']);
            array_push($this->_errorList, $fulfilmentSupplyOrderResult['ErrorMessage']['_']);
        }           
        //operation success
        if (isset($fulfilmentSupplyOrderResult['OperationSuccess']['_']) && $fulfilmentSupplyOrderResult['OperationSuccess']['_'] == 'true')
        {
            $this->_fulfilmentSupplyOrderResult->setOperationSuccess(true);
        }

        if(isset($fulfilmentSupplyOrderResult['CurrentPageNumber']))
        {
            $this->_fulfilmentSupplyOrderResult->setCurrentPageNumber($fulfilmentSupplyOrderResult['CurrentPageNumber']);
        }

        if(isset($fulfilmentSupplyOrderResult['NumberOfPages']))
        {
            $this->_fulfilmentSupplyOrderResult->setNumberOfPages($fulfilmentSupplyOrderResult['NumberOfPages']);
        }
        
        if(isset($fulfilmentSupplyOrderResult['SupplyOrderLineList']['SupplyOrderLine']))
        {
            $fulfilmentSupplyOrders = $fulfilmentSupplyOrderResult['SupplyOrderLineList']['SupplyOrderLine'];
            
            if(isset($fulfilmentSupplyOrders['SupplyOrderNumber']))
            {
                $fulfilmentSupplyOrders = array($fulfilmentSupplyOrders);
            }
        }
        
        if(isset($fulfilmentSupplyOrders))
        {
            foreach ($fulfilmentSupplyOrders as $fulfilmentSupplyOrder)
            {
                $supplyOrderResult = new SupplyOrder();
                // IsFod
                if (isset($fulfilmentSupplyOrder['IsFod']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['IsFod']))
                {
                    $supplyOrderResult->setIsFod($fulfilmentSupplyOrder['IsFod']);
                }
                // OrderedQuantity
                if (isset($fulfilmentSupplyOrder['OrderedQuantity']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['OrderedQuantity']))
                {
                    $supplyOrderResult->setOrderedQuantity($fulfilmentSupplyOrder['OrderedQuantity']);
                }
                // ProductEAN
                if (isset($fulfilmentSupplyOrder['ProductEAN']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['ProductEAN']))
                {
                    $supplyOrderResult->setProductEAN($fulfilmentSupplyOrder['ProductEAN']);
                }
                // ReceivedQuantity
                if (isset($fulfilmentSupplyOrder['ReceivedQuantity']))
                {
                    $supplyOrderResult->setReceivedQuantity($fulfilmentSupplyOrder['ReceivedQuantity']);
                }
                // OrderReference
                if (isset($fulfilmentSupplyOrder['OrderReferenceList']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['OrderReferenceList']))
                {
                    if(isset($fulfilmentSupplyOrder['OrderReferenceList']['a:string']))
                    {
                        $orderReferences = $fulfilmentSupplyOrder['OrderReferenceList']['a:string'];
                        
                        if (sizeof($orderReferences) == 1)
                        {
                            $orderReferences = array($orderReferences);
                        }
                    }

                    if(isset($orderReferences))
                    {
                        foreach ($orderReferences as $orderReference)
                        {
                            $supplyOrderResult->addOrderReferenceToToArray($orderReference);
                        }
                    }
                }
                // SellerProductReference
                if (isset($fulfilmentSupplyOrder['SellerProductReference']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['SellerProductReference']))
                {
                    $supplyOrderResult->setSellerProductReference($fulfilmentSupplyOrder['SellerProductReference']);
                }
                
                // SellerSupplyOrderNumber
                if (isset($fulfilmentSupplyOrder['SellerSupplyOrderNumber']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['SellerSupplyOrderNumber']))
                {
                    $supplyOrderResult->setSellerSupplyOrderNumber($fulfilmentSupplyOrder['SellerSupplyOrderNumber']);
                }

                // Status
                if (isset($fulfilmentSupplyOrder['Status']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['Status']))
                {
                    $supplyOrderResult->setStatus($fulfilmentSupplyOrder['Status']);
                }  

                // SupplyOrderNumber
                if (isset($fulfilmentSupplyOrder['SupplyOrderNumber']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['SupplyOrderNumber']))
                {                                                                   
                    $supplyOrderResult->setSupplyOrderNumber($fulfilmentSupplyOrder['SupplyOrderNumber']);
                }

                // UndeliveredQuantity
                if (isset($fulfilmentSupplyOrder['UndeliveredQuantity']))
                {
                    $supplyOrderResult->setUndeliveredQuantity($fulfilmentSupplyOrder['UndeliveredQuantity']);
                } 

                // Warehouse
                if (isset($fulfilmentSupplyOrder['Warehouse']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['Warehouse']))
                {
                    $supplyOrderResult->setWarehouse($fulfilmentSupplyOrder['Warehouse']);
                }

                // WarehouseReceptionMinDate
                if (isset($fulfilmentSupplyOrder['WarehouseReceptionMinDate']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrder['WarehouseReceptionMinDate']))
                {
                    $supplyOrderResult->setWarehouseReceptionMinDate($fulfilmentSupplyOrder['WarehouseReceptionMinDate']);
                } 

                $this->_fulfilmentSupplyOrderResult->addSupplyOrderToList($supplyOrderResult); 
            }
        }
    }

}

