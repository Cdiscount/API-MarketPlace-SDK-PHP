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
        if (!$this->_hasErrorMessage()) {
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

    /**
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['ValidateOrderListResponse']['ValidateOrderListResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            array_push($this->_errorList, $this->_errorMessage);
            return true;
        }
        return false;
    }

    private function _setValidateOrderResults()
    {
        $objResult = $this->_dataResponse['s:Body']['ValidateOrderListResponse']['ValidateOrderListResult']['ValidateOrderResults'];

        //print_r($objResult);
        //echo $objResult['ValidateOrderResult']['OrderNumber'];


        $arrays = false;
        foreach ($objResult['ValidateOrderResult'] as $validateOrderResult) {
            if (is_array($validateOrderResult)) {

                if (isset($validateOrderResult['OrderNumber'])) {
                    $orderResult = new ValidateOrderResult($validateOrderResult['OrderNumber']);
                    $this->_validateOrderResults->addValidateOrderResult($orderResult);
                    $arrays = true;
                }
            }
        }

        if (!$arrays) {
            $orderResult = new ValidateOrderResult($objResult['ValidateOrderResult']['OrderNumber']);

            if ($objResult['ValidateOrderResult']['Validated'] == 'true') {
                $orderResult->setValidated(true);
            }

            $validateOrderLineResults = new ValidateOrderLineResults();

            foreach ($objResult['ValidateOrderResult']['ValidateOrderLineResults']['ValidateOrderLineResult'] as $objValidateOrderLineResult) {
                //echo $objValidateOrderLineResult['SellerProductId'] . "<br/>";
                $validateOrderLineResult = new ValidateOrderLineResult($objValidateOrderLineResult['SellerProductId']);
                if ($objValidateOrderLineResult['Updated'] == 'true') {
                    $validateOrderLineResult->setUpdated(true);
                }
                $validateOrderLineResults->addValidateOrderLineResult($validateOrderLineResult);
            }

            $orderResult->setValidateOrderLineResults($validateOrderLineResults);
            $this->_validateOrderResults->addValidateOrderResult($orderResult);
        }
    }



}