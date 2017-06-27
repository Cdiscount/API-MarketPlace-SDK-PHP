<?php

/* 
 * Created by Cdiscount
 * Date : 26/04/2017
 * Time : 17:46
 */
namespace Sdk\Soap\Fulfillment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Fulfilment\ProductStockList;
use \Sdk\Soap\Common\SoapTools;
use \Sdk\Fulfilment\OrderStatusMessage;

class GetExternalOrderStatusResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

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

     /*
     * GetExternalOrderStatusResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();
        
        // Check For error message
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['GetExternalOrderStatusResponse']['GetExternalOrderStatusResult']))
        {
            $this->_setGlobalInformations();
            $this->generateExternalOrderStatus();
        }
    }

    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetExternalOrderStatusResponse']['GetExternalOrderStatusResult'];
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
        $objError = $this->_dataResponse['s:Body']['GetExternalOrderStatusResponse']['GetExternalOrderStatusResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;

    }

     /*
     * Fill the external Order Status from XML response
     */
    private function generateExternalOrderStatus()
    {
            $externalOrderStatusXml = $this->_dataResponse['s:Body']['GetExternalOrderStatusResponse']['GetExternalOrderStatusResult'];
         
           //errorMessage and errorList
            if (isset($externalOrderStatusXml['a:ErrorMessage']['_']) && strlen($externalOrderStatusXml['a:ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($externalOrderStatusXml['a:ErrorMessage']))
            {
                $errorMessage->setErrorMessage($externalOrderStatusXml['a:ErrorMessage']['_']);
                $errorMessage->addErrorToList($externalOrderStatusXml['a:ErrorMessage']['_']);
            }  

           //operation success
            if (isset($externalOrderStatusXml['a:OperationSuccess']['_']) && $externalOrderStatusXml['a:OperationSuccess']['_'] == 'true')
            {
                $operationSuccess->setOperationSuccess(true);
            }   

             //Status
             if (isset($externalOrderStatusXml['a:Status']) && !SoapTools::isSoapValueNull($externalOrderStatusXml['a:Status']))
            {       
                $this->_status= $externalOrderStatusXml['a:Status'];  
            }          
    }    
 }
