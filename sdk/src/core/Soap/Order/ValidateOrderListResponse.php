<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 09:19
 */

namespace Sdk\Soap\Order;


use Sdk\Order\Validate\ValidateOrderLineResult;
use Sdk\Order\Validate\ValidateOrderLineResults;
use Sdk\Order\Validate\ValidateOrderResult;
use Sdk\Order\Validate\ValidateOrderResults;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class ValidateOrderListResponse extends iResponse
{

    private $_dataResponse;

    /**
     * @var \Sdk\Order\Validate\ValidateOrderResults
     */
    private $_validateOrderResults = null;

    /**
     * @return ValidateOrderResults
     */
    public function getValidateOrderResults()
    {
        return $this->_validateOrderResults;
    }

    /**
     * ValidateOrderListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        $this->_errorList = array();

        // Check for error messages
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['ValidateOrderListResponse']['ValidateOrderListResult'])) {
            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_validateOrderResults = new ValidateOrderResults();

            $this->_setValidateOrderResults();
            
        }

    }

    /**
     *
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['ValidateOrderListResponse']['ValidateOrderListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    private function _setValidateOrderResults()
    {
        $objResult = $this->_dataResponse['s:Body']['ValidateOrderListResponse']['ValidateOrderListResult'];

        
        /*
         * \Sdk\Order\validate\ValidateOrderresult
         */
        foreach ( $objResult['ValidateOrderResults'] as $validateOrderResult ) {
            if( isset($validateOrderResult['OrderNumber']) && !SoapTools::isSoapValueNull($validateOrderResult['OrderNumber']) ){
                
                //OrderNumber
                $orderResult = new ValidateOrderResult($validateOrderResult['OrderNumber']);
                
                //Validated
                if (isset($validateOrderResult['Validated']) &&  !SoapTools::isSoapValueNull($validateOrderResult['OrderNumber']) && $validateOrderResult['Validated'] == 'true') {
                    $orderResult->setValidated(true);
                }
                    
                $validateOrderLineResults = new ValidateOrderLineResults();

                /*
                 * \Sdk\Order\Validate\ValidateOrderLineResult
                 */
                foreach ($validateOrderResult['ValidateOrderLineResults'] as $validateOrderLineResult) {
                    if(isset($validateOrderLineResult['SellerProductId']) && !SoapTools::isSoapValueNull($validateOrderLineResult['SellerProductId'])){
                        
                        $orderLineResult = new ValidateOrderLineResult($validateOrderLineResult['SellerProductId']);
                        if (isset($validateOrderLineResult['Updated']) && !SoapTools::isSoapValueNull($validateOrderLineResult['Updated']) && $validateOrderLineResult['Updated'] == 'true') {
                            $orderLineResult->setUpdated(true);
                        }
                        $validateOrderLineResults->addValidateOrderLineResult($orderLineResult);
                    }                 
                }

                $orderResult->setValidateOrderLineResults($validateOrderLineResults);
                $this->_validateOrderResults->addValidateOrderResult($orderResult);
            }           
        }
    }
}