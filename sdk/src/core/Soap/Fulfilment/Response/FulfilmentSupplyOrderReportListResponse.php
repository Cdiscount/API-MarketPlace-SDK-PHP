<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use \Sdk\Fulfilment\FulfilmentSupplyOrderReportListResult;
use \Sdk\Fulfilment\SupplyOrderReport;
use \Sdk\Fulfilment\SupplyOrderReportLine;
use \Sdk\Fulfilment\Error;

class FulfilmentSupplyOrderReportListResponse extends iResponse
{
    
    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var GetFulfilmentSupplyOrderReportListResult
     */
    private $_fulfilmentSupplyOrderReportListResult= null;
    
    /*
     * @return \Sdk\Fulfilment\FulfilmentSupplyOrderReportListResult
     */
    public function getFulfilmentSupplyOrderReportListResult()
    {
        return $this->_fulfilmentSupplyOrderReportListResult;
    }

    /*
     * @param $fulfilmentSupplyOrderReportListResult
     */
     public function setFulfilmentSupplyOrderReportListResult($fulfilmentSupplyOrderReportListResult)
    {
        $this->_fulfilmentSupplyOrderReportListResult=$fulfilmentSupplyOrderReportListResult;
    }
    
    /*
     * SubmitFulfilmentSupplyOrderResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();
        
        // Check For error message
        if(isset($this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderReportListResponse']['GetFulfilmentSupplyOrderReportListResult']))
        {
            $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderReportListResponse']['GetFulfilmentSupplyOrderReportListResult']);
            if ($this->_operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->generateGetFulfilmentSupplyOrderReportListResult();
            }
        }     
    }
    
    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderReportListResponse']['GetFulfilmentSupplyOrderReportListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    

      private function generateGetFulfilmentSupplyOrderReportListResult()
      {
           $fulfilmentSupplyOrderReportListResultXml = $this->_dataResponse['s:Body']['GetFulfilmentSupplyOrderReportListResponse']['GetFulfilmentSupplyOrderReportListResult'];
         
            $this->_fulfilmentSupplyOrderReportListResult = new FulfilmentSupplyOrderReportListResult();
            
             //errorMessage and errorList
            if (isset($fulfilmentSupplyOrderReportListResultXml['ErrorMessage']['_']) && strlen($fulfilmentSupplyOrderReportListResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($fulfilmentSupplyOrderReportListResultXml['ErrorMessage']))
            {
                $this->_fulfilmentSupplyOrderReportListResult->setErrorMessage($fulfilmentSupplyOrderReportListResultXml['ErrorMessage']['_']);
                $this->_fulfilmentSupplyOrderReportListResult->addErrorToList($fulfilmentSupplyOrderReportListResultXml['ErrorMessage']['_']);
                array_push($this->_errorList, $fulfilmentSupplyOrderReportListResultXml['ErrorMessage']['_']);
            }           
            //operation success
            if (isset($fulfilmentSupplyOrderReportListResultXml['OperationSuccess']['_']) && $fulfilmentSupplyOrderReportListResultXml['OperationSuccess']['_'] == 'true')
            {
               $this->_fulfilmentSupplyOrderReportListResult->setOperationSuccess(true);
            }
            
            if(isset($fulfilmentSupplyOrderReportListResultXml['NumberOfPages']))
            {
                 $this->_fulfilmentSupplyOrderReportListResult->setNumberOfPages($fulfilmentSupplyOrderReportListResultXml['NumberOfPages']);
            }

            if(isset($fulfilmentSupplyOrderReportListResultXml['CurrentPageNumber']))
            { 
                 $this->_fulfilmentSupplyOrderReportListResult->setCurrentPageNumber($fulfilmentSupplyOrderReportListResultXml['CurrentPageNumber']);
            }
            
            if (isset($fulfilmentSupplyOrderReportListResultXml['ReportList']) && !SoapTools::isSoapValueNull($fulfilmentSupplyOrderReportListResultXml['ReportList']))
            { 
                $reportListObj=$fulfilmentSupplyOrderReportListResultXml['ReportList'];
                
                if(isset($reportListObj['SupplyOrderReport']))
                {
                    $supplyOrderReports = $reportListObj['SupplyOrderReport'];

                    if(isset($supplyOrderReports['DepositId']))
                    {
                        $supplyOrderReports = array($supplyOrderReports);
                    }
                }
                if(isset($supplyOrderReports))
                {
                    foreach($supplyOrderReports as $supplyOrder)
                    {
                        $supplyOrderReport= new SupplyOrderReport();
                        $supplyOrderReport->setDepositId($supplyOrder['DepositId']);
                    
                        if(isset($supplyOrder['ReportLineList']['SupplyOrderReportLine']))
                        {
                            $reportLines = $supplyOrder['ReportLineList']['SupplyOrderReportLine'];
   
                            if(isset($reportLines['SupplyOrderNumber']))
                            {
                                $reportLines = array($reportLines);
                            }
                        }
                        
                        if(isset($reportLines))
                        {
                            foreach($reportLines as $reportLine)
                            {
                                $supplyOrderReportLine = new SupplyOrderReportLine();

                                if(isset($reportLine['ErrorDetails']['a:KeyValueOfintstring']))
                                { 
                                    $errorDetails = $reportLine['ErrorDetails']['a:KeyValueOfintstring'];

                                    if(isset($errorDetails['a:Key']))
                                    {
                                        $errorDetails = array($errorDetails);
                                    }
                                }

                                if(isset($errorDetails))
                                {
                                    foreach($errorDetails as $errorItem)
                                    {
                                        $error = new Error();
                                         if(isset($errorItem['a:Key']) && !SoapTools::isSoapValueNull($errorItem['a:Key']))
                                         {
                                             $error->setErrorCode(htmlentities($errorItem['a:Key']));
                                         }

                                         if(isset($errorItem['a:Value']) && !SoapTools::isSoapValueNull($errorItem['a:Value']))
                                         {
                                             $error->setErrorMessage(htmlentities($errorItem['a:Value']));
                                         }
                                        $supplyOrderReportLine->addToErrorList($error);
                                    }
                                    
                                    $errorDetails=null;
                                }
                                                              
                                if(isset($reportLine['OrderedQuantity']) && !SoapTools::isSoapValueNull($reportLine['OrderedQuantity']))
                                {
                                    $supplyOrderReportLine->setOrderedQuantity($reportLine['OrderedQuantity']);
                                }
                                
                                if(isset($reportLine['ProductEan']) && !SoapTools::isSoapValueNull($reportLine['ProductEan']))
                                {
                                    $supplyOrderReportLine->setProductEan($reportLine['ProductEan']);
                                }
                                
                                if(isset($reportLine['SellerId']) && !SoapTools::isSoapValueNull($reportLine['SellerId']))
                                {
                                    $supplyOrderReportLine->setSellerId($reportLine['SellerId']);
                                }
                                
                                if(isset($reportLine['SellerProductReference']) && !SoapTools::isSoapValueNull($reportLine['SellerProductReference']))
                                {
                                    $supplyOrderReportLine->setSellerProductReference($reportLine['SellerProductReference']);
                                }

                                if(isset($reportLine['SellerSupplyOrderNumber']) && !SoapTools::isSoapValueNull($reportLine['SellerSupplyOrderNumber']))
                                {
                                    $supplyOrderReportLine->setSellerSupplyOrderNumber($reportLine['SellerSupplyOrderNumber']);
                                }
                                
                                if(isset($reportLine['SupplyOrderNumber']) && !SoapTools::isSoapValueNull($reportLine['SupplyOrderNumber']))
                                {
                                    $supplyOrderReportLine->setSupplyOrderNumber($reportLine['SupplyOrderNumber']);
                                }
                                
                                if(isset($reportLine['Warehouse']) && !SoapTools::isSoapValueNull($reportLine['Warehouse']))
                                {
                                    $supplyOrderReportLine->setWarehouse($reportLine['Warehouse']);
                                }
                                
                                if(isset($reportLine['WarehouseReceptionMinDate']) && !SoapTools::isSoapValueNull($reportLine['WarehouseReceptionMinDate']))
                                {
                                    $supplyOrderReportLine->setWarehouseReceptionMinDate($reportLine['WarehouseReceptionMinDate']);
                                }
                            $supplyOrderReport->addReportLineList($supplyOrderReportLine);
                            }
                        }        
                        $this->_fulfilmentSupplyOrderReportListResult->addReportList($supplyOrderReport);
                    }
                }
            }                             
      } 
}
