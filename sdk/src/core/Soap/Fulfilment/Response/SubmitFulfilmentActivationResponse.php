<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitFulfilmentActivationResult;

class SubmitFulfilmentActivationResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;
    
    
    private $_submitFulfilmentActivationResult= null;
    
    public function getSubmitFulfilmentActivationResult()
    {
        return $this->_submitFulfilmentActivationResult;
    }

    /*
     * @param  $submitFulfilmentActivationResult \Sdk\Fulfilment\SubmitFulfilmentActivationResult
     */
     public function setSubmitFulfilmentActivationResult($submitFulfilmentActivationResult)
    {
        $this->_submitFulfilmentActivationResult=$submitFulfilmentActivationResult;
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
        if(isset($this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult']))
        {
             $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult']);
             if ($this->_operationSuccess)
              {
                $this->_setGlobalInformations();
                $this->generateDepositIdResult();
              }
        }    
    }
    
    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    
    public function generateDepositIdResult()
    { 
        $submitFulfilmentActivationResultXml = $this->_dataResponse['s:Body']['SubmitFulfilmentActivationResponse']['SubmitFulfilmentActivationResult'];
    
        $this->_submitFulfilmentActivationResult = new SubmitFulfilmentActivationResult();

        if (isset($submitFulfilmentSupplyOrderResultXml['ErrorMessage']['_']) && strlen($submitFulfilmentActivationResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitFulfilmentActivationResultXml['ErrorMessage']))
        {
            $this->_submitFulfilmentActivationResult->setErrorMessage($submitFulfilmentActivationResultXml['ErrorMessage']['_']);
            $this->_submitFulfilmentActivationResult->addErrorToList($submitFulfilmentActivationResultXml['ErrorMessage']['_']);
            array_push($this->_errorList, $submitFulfilmentActivationResultXml['ErrorMessage']['_']);
        }           
        //operation success
        if (isset($submitFulfilmentActivationResultXml['OperationSuccess']['_']) && $submitFulfilmentActivationResultXml['OperationSuccess']['_'] == 'true')
        {
            $this->_submitFulfilmentActivationResult->setOperationSuccess(true);
        }

        //deposit id
        if (isset($submitFulfilmentActivationResultXml['DepositId']) && !SoapTools::isSoapValueNull($submitFulfilmentActivationResultXml['DepositId']))
        {        
            $this->_submitFulfilmentActivationResult->setDepositId($submitFulfilmentActivationResultXml['DepositId']);  
        }                             
    }

}
