<?php

/* 
 * Created by El Ibaoui Otmane (SQLI)
 * Date : 08/05/2017
 * Time : 17:46
 */
namespace Sdk\Soap\Fulfillment\Response;

use Sdk\Soap\Common\iResponse;
use \Sdk\Fulfilment\ProductStockList;
use \Sdk\Fulfilment\ProductStockListMessage;
use \Sdk\Soap\Common\SoapTools;

class CreateExternalOrderResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /*
     * CreateExternalOrderResponse constructor
     * @param $response 
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        // Check For Operation Success
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['CreateExternalOrderResponse']['CreateExternalOrderResult']))
        {
            $this->_operationSuccess=true;
            $this->_setGlobalInformations();
        }
    }
    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['CreateExternalOrderResponse']['CreateExternalOrderResult'];
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
        $objError = $this->_dataResponse['s:Body']['CreateExternalOrderResponse']['CreateExternalOrderResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
 }
