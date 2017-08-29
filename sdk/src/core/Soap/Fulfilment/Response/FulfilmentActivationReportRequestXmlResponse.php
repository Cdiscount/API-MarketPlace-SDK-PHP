<?php
/* 
 * Created by EQUIPE-SQLI
 * Date : 15/05/2017
 * Time : 08:46
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use \Sdk\Fulfilment\FulfilmentActivationReportListResult;
use \Sdk\Fulfilment\FulfilmentActivationReport;
use \Sdk\Fulfilment\FulfilmentActivationReportDetails;

class FulfilmentActivationReportRequestXmlResponse extends iResponse
{
    
     /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * @var GetFulfilmentActivationReportListResult
     */
    private $_fulfilmentActivationReportListResult = null;
    
    /*
     * @return 
     */
    public function getFulfilmentActivationReportListResult()
    {
        return $this->_fulfilmentActivationReportListResult;
    }

    /*
     * @param FulfilmentActivationReportListResult
     */
     public function setFulfilmentSupplyOrderReportListResult($fulfilmentActivationReportListResult)
    {
        $this->_fulfilmentActivationReportListResult=$fulfilmentActivationReportListResult;
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
        if(isset($this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult']))
        {
            $fulfilmentActivationReportListResultXml = $this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult'];
        }
        // Check For error message
        if(isset($this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult']))
        {
            if ($this->isOperationSuccess($this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult']))
                {
                    $this->_setGlobalInformations();
                    $this->generateResult();
                }
         }
     }
    
     /**
     * Check if the response has an error message
     * @return bool
     */
    protected function isOperationSuccess($headerResult)
    {        
       $objError = iResponse::isOperationSuccess($headerResult);
                
        if (isset($objError)) {
            $this->_operationSuccess = $objError;
        }
        
        if(isset($objError) && $objError == false ){
            return true;
        }
        
        return $objError;
    }
    
    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    private function generateResult()
    {
        
        $fulfilmentActivationReportListResult = $this->_dataResponse['s:Body']['GetFulfilmentActivationReportListResponse']['GetFulfilmentActivationReportListResult'];

        $this->_fulfilmentActivationReportListResult = new FulfilmentActivationReportListResult();
        
        if(isset($fulfilmentActivationReportListResult['FulfilmentActivationReportList']['FulfilmentActivationReport']))
        {
            $fulfilmentActivationReports = $fulfilmentActivationReportListResult['FulfilmentActivationReportList']['FulfilmentActivationReport'];
            
            if(isset($fulfilmentActivationReports['DepositId']))
            {
                $fulfilmentActivationReports = array($fulfilmentActivationReports);
            }
        }

        if(isset($fulfilmentActivationReports))
        {
            foreach ($fulfilmentActivationReports as $fulfilmentActivationReportItem)
            {
                $fulfilmentActivationReport = new FulfilmentActivationReport();

                if(isset($fulfilmentActivationReportItem['DepositId']))
                {
                    $fulfilmentActivationReport->setDepositId($fulfilmentActivationReportItem['DepositId']);
                }

                if(isset($fulfilmentActivationReportItem['ReportDate']) && !SoapTools::isSoapValueNull($fulfilmentActivationReportItem['ReportDate']))
                {
                    $fulfilmentActivationReport->setReportDate($fulfilmentActivationReportItem['ReportDate']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfRemainingProductsToProcess']))
                {
                    $fulfilmentActivationReport->setNumberOfRemainingProductsToProcess($fulfilmentActivationReportItem['NumberOfRemainingProductsToProcess']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfProductsInError']))
                {
                    $fulfilmentActivationReport->setNumberOfProductsInError($fulfilmentActivationReportItem['NumberOfProductsInError']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfProducts($fulfilmentActivationReportItem['NumberOfProducts']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfProcessedProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfProcessedProducts($fulfilmentActivationReportItem['NumberOfProcessedProducts']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfDeactivatedProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfDeactivatedProducts($fulfilmentActivationReportItem['NumberOfDeactivatedProducts']);
                }

                if(isset($fulfilmentActivationReportItem['NumberOfActivatedProducts']))
                {
                    $fulfilmentActivationReport->setNumberOfActivatedProducts($fulfilmentActivationReportItem['NumberOfActivatedProducts']);
                }
                
                if(isset($fulfilmentActivationReportItem['DetailsList']['FulfilmentActivationReportDetails']))
                {
                    $FulfilmentActivationReportDetailsList = $fulfilmentActivationReportItem['DetailsList']['FulfilmentActivationReportDetails'];
                    
                    if(isset($FulfilmentActivationReportDetailsList['ProductEAN']))
                    {
                        $FulfilmentActivationReportDetailsList = array($FulfilmentActivationReportDetailsList);
                    }
                }

                if(isset($FulfilmentActivationReportDetailsList))
                {
                    foreach ($FulfilmentActivationReportDetailsList as $FulfilmentActivationReportDetailsItem)
                    {
                        $fulfilmentActivationReportDetails = new FulfilmentActivationReportDetails();
                    
                        if(isset($FulfilmentActivationReportDetailsItem['Action']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Action']))
                        {
                            $fulfilmentActivationReportDetails->setAction($FulfilmentActivationReportDetailsItem['Action']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['ActionSuccess']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['ActionSuccess']))
                        {
                            $fulfilmentActivationReportDetails->setActionSuccess($FulfilmentActivationReportDetailsItem['ActionSuccess']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Description']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['Description']))
                        {
                            $fulfilmentActivationReportDetails->setDescription($FulfilmentActivationReportDetailsItem['Description']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Length']))
                        {
                            $fulfilmentActivationReportDetails->setLength($FulfilmentActivationReportDetailsItem['Length']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Height']))
                        {
                            $fulfilmentActivationReportDetails->setHeight($FulfilmentActivationReportDetailsItem['Height']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['SKU']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['SKU']))
                        {
                            $fulfilmentActivationReportDetails->setSKU($FulfilmentActivationReportDetailsItem['SKU']);
                        }
                        
                        if(isset($FulfilmentActivationReportDetailsItem['SellerProductReference']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['SellerProductReference']))
                        {
                            $fulfilmentActivationReportDetails->setSellerProductReference($FulfilmentActivationReportDetailsItem['SellerProductReference']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['ProductEAN']) && !SoapTools::isSoapValueNull($FulfilmentActivationReportDetailsItem['ProductEAN']))
                        {
                            $fulfilmentActivationReportDetails->setProductEAN($FulfilmentActivationReportDetailsItem['ProductEAN']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Weight']))
                        {
                            $fulfilmentActivationReportDetails->setWeight($FulfilmentActivationReportDetailsItem['Weight']);
                        }

                        if(isset($FulfilmentActivationReportDetailsItem['Width']))
                        {
                            $fulfilmentActivationReportDetails->setWidth($FulfilmentActivationReportDetailsItem['Width']);
                        }

                        $fulfilmentActivationReport->addFulfilmentActivationReportDetails($fulfilmentActivationReportDetails);
                    }
                }
                
                $this->_fulfilmentActivationReportListResult->addFulfilmentActivationReport($fulfilmentActivationReport); 
            }
        }
    }
}
