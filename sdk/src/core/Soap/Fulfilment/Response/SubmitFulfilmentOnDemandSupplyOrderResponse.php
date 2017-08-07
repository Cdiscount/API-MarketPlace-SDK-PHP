<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderResult;

class SubmitFulfilmentOnDemandSupplyOrderResponse extends iResponse
{
    
    /**
     * @var array
     */
    private $_dataResponse = null;
    
    /*
     * @var SubmitFulfilmentOnDemandSupplyOrderResult
     */
    private $_submitFulfilmentOnDemandSupplyOrderResult= null;
    
    /*
     * @return \Sdk\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderResult
     */
    public function getSubmitFulfilmentOnDemandSupplyOrderResult()
    {
        return $this->_submitFulfilmentOnDemandSupplyOrderResult;
    }

    /*
     * @param  $submitFulfilmentOnDemandSupplyOrderResult
     */
     public function setSubmitFulfilmentOnDemandSupplyOrderResult($submitFulfilmentOnDemandSupplyOrderResult)
    {
        $this->_submitFulfilmentOnDemandSupplyOrderResult=$submitFulfilmentOnDemandSupplyOrderResult;
    }
    
    /*
     * SubmitFulfilmentOnDemandSupplyOrderResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();
        
        $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitFulfilmentOnDemandSupplyOrderResponse']['SubmitFulfilmentOnDemandSupplyOrderResult']);
        if ($this->_operationSuccess)
        {
            $this->_setGlobalInformations();
            $this->generateDepositIdResult();
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitFulfilmentOnDemandSupplyOrderResponse']['SubmitFulfilmentOnDemandSupplyOrderResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    
    private function generateDepositIdResult()
    {
        $submitFulfilmentOnDemandSupplyOrderResultXml = $this->_dataResponse['s:Body']['SubmitFulfilmentOnDemandSupplyOrderResponse']['SubmitFulfilmentOnDemandSupplyOrderResult'];
         
            $this->_submitFulfilmentOnDemandSupplyOrderResult = new SubmitFulfilmentOnDemandSupplyOrderResult();
             //errorMessage and errorList
            if (isset($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']) && strlen($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']))
            {
                $this->_submitFulfilmentOnDemandSupplyOrderResult->setErrorMessage($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']);
                $this->_submitFulfilmentOnDemandSupplyOrderResult->addErrorToList($submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']);
                array_push($this->_errorList, $submitFulfilmentOnDemandSupplyOrderResultXml['ErrorMessage']['_']);
            }           
            //operation success
            if (isset($submitFulfilmentOnDemandSupplyOrderResultXml['OperationSuccess']['_']) && $submitFulfilmentOnDemandSupplyOrderResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_submitFulfilmentOnDemandSupplyOrderResult->setOperationSuccess(true);
            }

            //deposit id
            if (isset($submitFulfilmentOnDemandSupplyOrderResultXml['DepositId']) && !SoapTools::isSoapValueNull($submitFulfilmentOnDemandSupplyOrderResultXml['DepositId']))
            {        
                $this->_submitFulfilmentOnDemandSupplyOrderResult->setDepositId($submitFulfilmentOnDemandSupplyOrderResultXml['DepositId']);  
            }                             
    }
}
