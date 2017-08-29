<?php
/*
 * Created by CDiscount
 * Date: 18/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\SubmitOfferStateActionResult;

class SubmitOfferStateActionResponse extends iResponse
{
    
    /**
     * @var array
     */
    private $_dataResponse = null;
    
    /*
     * @var SubmitOfferStateActionResult
     */
    private $_submitOfferStateActionResult= null;
    
    /*
     * @return submitOfferStateActionResult
     */
    public function getSubmitOfferStateActionResult()
    {
        return $this->_submitOfferStateActionResult;
    }

    /*
     * @param  $submitOfferStateActionResult \Sdk\Fulfilment\SubmitOfferStateActionResult
     */
     public function setSubmitOfferStateActionResult($submitOfferStateActionResult)
    {
        $this->_submitOfferStateActionResult=$submitOfferStateActionResult;
    }
    
    /*
     * SubmitOfferStateActionResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();
        
        // Check For error message
        if(isset($this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult']))
        {   
            $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult']);   
            if ($this->_operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->generateResult();
            }
        }      
    }
    
    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    
    private function generateResult()
    {
        $submitOfferStateActionResultXml = $this->_dataResponse['s:Body']['SubmitOfferStateActionResponse']['SubmitOfferStateActionResult'];
         
        $this->_submitOfferStateActionResult = new SubmitOfferStateActionResult();
         //errorMessage and errorList
            if (isset($submitOfferStateActionResultXml['ErrorMessage']['_']) && strlen($submitOfferStateActionResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($submitOfferStateActionResultXml['ErrorMessage']))
            {
                $this->_submitOfferStateActionResult->setErrorMessage($submitOfferStateActionResultXml['ErrorMessage']['_']);
                $this->_submitOfferStateActionResult->addErrorToList($submitOfferStateActionResultXml['ErrorMessage']['_']);
                array_push($this->_errorList, $submitOfferStateActionResultXml['ErrorMessage']['_']);
            }           
            //operation success
            if (isset($submitOfferStateActionResultXml['OperationSuccess']['_']) && $submitOfferStateActionResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_submitOfferStateActionResult->setOperationSuccess(true);
            }
            else
            {
                $this->_submitOfferStateActionResult->setOperationSuccess(false);
            }                            
    }

}
