<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitFulfilmentSupplyOrderResult;

class SubmitFulfilmentSupplyOrderResponse extends iResponse
{
    
    /**
     * @var array
     */
    private $_dataResponse = null;
    
    /*
     * @var SubmitFulfilmentSupplyOrderResult
     */
    private $_submitFulfilmentSupplyOrderResult= null;
    
    /*
     * @return \Sdk\Fulfilment\SubmitFulfilmentSupplyOrderResult
     */
    public function getSubmitFulfilmentSupplyOrderResult()
    {
        return $this->_submitFulfilmentSupplyOrderResult;
    }

    /*
     * @param  $submitFulfilmentSupplyOrderResult
     */
     public function setSubmitFulfilmentSupplyOrderResult($submitFulfilmentSupplyOrderResult)
    {
        $this->_submitFulfilmentSupplyOrderResult=$submitFulfilmentSupplyOrderResult;
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
        
        if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']))
        {
            $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']);
            if ($this->_operationSuccess)
             {
                 $this->_setGlobalInformations();
                 $this->generateDepositIdResult();
             }
        }  

		if(isset($this->_dataResponse['s:Body']['s:Fault']['faultstring']))
		{
			$this->generateFaultResult();
		}	   
    }
    
    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']))
        {
            $objInfoResult = $this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult'];
            $this->_tokenID = $objInfoResult['TokenId'];
            $this->_sellerLogin = $objInfoResult['SellerLogin'];
        }
    }
    
	/**
     * Get Deposit id
     */
    private function generateDepositIdResult()
    {
       if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult']))
       {
            $submitFulfilmentSupplyOrderResultXml = $this->_dataResponse['s:Body']['SubmitFulfilmentSupplyOrderResponse']['SubmitFulfilmentSupplyOrderResult'];
       }
         
            $this->_submitFulfilmentSupplyOrderResult = new SubmitFulfilmentSupplyOrderResult();
             //errorMessage and errorList
            if (isset($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']) && strlen($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitFulfilmentSupplyOrderResultXml['ErrorMessage']))
            {
                $this->_submitFulfilmentSupplyOrderResult->setErrorMessage($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']);
                $this->_submitFulfilmentSupplyOrderResult->addErrorToList($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']);
                array_push($this->_errorList, $submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']);
            }           
            //operation success
            if (isset($submitFulfilmentSupplyOrderResultXml['OperationSuccess']['_']) && $submitFulfilmentSupplyOrderResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_submitFulfilmentSupplyOrderResult->setOperationSuccess(true);
            }
            //deposit id
            if (isset($submitFulfilmentSupplyOrderResultXml['DepositId']))
            {        
                $this->_submitFulfilmentSupplyOrderResult->setDepositId($submitFulfilmentSupplyOrderResultXml['DepositId']);
            }                             
    }
	
	 /**
     * Get error list
     */
	 private function generateFaultResult()
    {
       if(isset($this->_dataResponse['s:Body']['s:Fault']['faultstring']['_']))
       {
            $submitFulfilmentSupplyOrderResultXml = $this->_dataResponse['s:Body']['s:Fault']['faultstring']['_'];
       
            $this->_submitFulfilmentSupplyOrderResult = new SubmitFulfilmentSupplyOrderResult();
             //errorMessage and errorList            
			$this->_submitFulfilmentSupplyOrderResult->setErrorMessage($submitFulfilmentSupplyOrderResultXml);
			$this->_submitFulfilmentSupplyOrderResult->addErrorToList($submitFulfilmentSupplyOrderResultXml);
			array_push($this->_errorList, $submitFulfilmentSupplyOrderResultXml);
                      
            //operation success
            $this->_submitFulfilmentSupplyOrderResult->setOperationSuccess(false);
				
        }
    }
}
