<?php
/*
 * Created by Mohamed MGUILD
 * Date: 10/05/2017
 */

namespace Sdk\Soap\Fulfilment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Soap\Common\SoapTools;
use Sdk\Fulfilment\GetFulfilmentDeliveryDocumentResult;

class GetFulfilmentDeliveryDocumentResponse extends iResponse
{
    
    /**
     * @var array
     */
    private $_dataResponse = null;
    
    /*
     * @var getFulfilmentDeliveryDocumentResult
     */
    private $_getFulfilmentDeliveryDocumentResult= null;
    
    /*
     * @return getFulfilmentDeliveryDocumentResult
     */
    public function getFulfilmentDeliveryDocumentResult()
    {
        return $this->_getFulfilmentDeliveryDocumentResult;
    }

    /*
     * @param  $getFulfilmentDeliveryDocumentResult \Sdk\Fulfilment\GetFulFilmentDeliveryDocumentResult
     */
     public function setGetFulfilmentDeliveryDocumentResult($getFulfilmentDeliveryDocumentResult)
    {
        $this->_getFulfilmentDeliveryDocumentResult=$getFulfilmentDeliveryDocumentResult;
    }
    
    /*
     * getFulfilmentDeliveryDocumentResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_errorList = array();

        // Check For error message
        if(isset($this->_dataResponse['s:Body']['GetFulfilmentDeliveryDocumentResponse']['GetFulfilmentDeliveryDocumentResult']))
        {
            $this->_operationSuccess = $this->isOperationSuccess($this->_dataResponse['s:Body']['GetFulfilmentDeliveryDocumentResponse']['GetFulfilmentDeliveryDocumentResult']);
            if ($this->_operationSuccess)
            {
                $this->_setGlobalInformations();
                $this->generatePdfDocumentResult();
            }
        }    
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetFulfilmentDeliveryDocumentResponse']['GetFulfilmentDeliveryDocumentResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    
    /**
     * Get Pdf document result
     */
    private function generatePdfDocumentResult()
    {
        $getFulfilmentDeliveryDocumentResultXml = $this->_dataResponse['s:Body']['GetFulfilmentDeliveryDocumentResponse']['GetFulfilmentDeliveryDocumentResult'];
         
            $this->_getFulfilmentDeliveryDocumentResult = new GetFulfilmentDeliveryDocumentResult();
             //errorMessage and errorList
            if (isset($getFulfilmentDeliveryDocumentResultXml['ErrorMessage']['_']) && strlen($getFulfilmentDeliveryDocumentResultXml['ErrorMessage']['_']) > 0 && !SoapTools::isSoapValueNull($getFulfilmentDeliveryDocumentResultXml['ErrorMessage']))
            {
                $this->_getFulfilmentDeliveryDocumentResult->setErrorMessage($getFulfilmentDeliveryDocumentResultXml['ErrorMessage']['_']);
                $this->_getFulfilmentDeliveryDocumentResult->addErrorToList($getFulfilmentDeliveryDocumentResultXml['ErrorMessage']['_']);
                array_push($this->_errorList, $getFulfilmentDeliveryDocumentResultXml['ErrorMessage']['_']);
            }           
            //operation success
            if (isset($getFulfilmentDeliveryDocumentResultXml['OperationSuccess']['_']) && $getFulfilmentDeliveryDocumentResultXml['OperationSuccess']['_'] == 'true')
            {
                $this->_getFulfilmentDeliveryDocumentResult->setOperationSuccess(true);
            }

            //PdfDocucment
            if (isset($getFulfilmentDeliveryDocumentResultXml['a:PdfDocument']) && !SoapTools::isSoapValueNull($getFulfilmentDeliveryDocumentResultXml['a:PdfDocument']))
            {        
                $this->_getFulfilmentDeliveryDocumentResult->setPdfDocument($getFulfilmentDeliveryDocumentResultXml['a:PdfDocument']);  
            }                             
    }
}
