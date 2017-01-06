<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 15/11/2016
 * Time: 16:26
 */

namespace Sdk\Soap\Seller\Response;


use Sdk\Seller\SellerIndicator;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class GetSellerIndicatorsResponse extends iResponse
{
    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_sellerIndicators = null;

    /**
     * @return array
     */
    public function getSellerIndicators()
    {
        return $this->_sellerIndicators;
    }

    /**
     * GetSellerIndicatorsResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        /** Check for error message */
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_sellerIndicators = array();

            $this->_generateSellerIndicatorsListFromXML($this->_dataResponse['s:Body']['GetSellerIndicatorsResponse']['GetSellerIndicatorsResult']['SellerIndicators']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetSellerIndicatorsResponse']['GetSellerIndicatorsResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetSellerIndicatorsResponse']['GetSellerIndicatorsResult']['ErrorMessage'];
        $this->_errorList = array();

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            array_push($this->_errorList, $this->_errorMessage);
            return true;
        }
        return false;
    }

    /**
     * @param $sellerIndicators
     */
    private function _generateSellerIndicatorsListFromXML($sellerIndicators)
    {
        if (isset($sellerIndicators['SellerIndicator'])) {
            foreach ($sellerIndicators['SellerIndicator'] as $sellerIndicatorXML) {

                $sellerIndicator = new SellerIndicator();

                if (isset($sellerIndicatorXML['ComputationDate']) && !SoapTools::isSoapValueNull($sellerIndicatorXML['ComputationDate'])) {
                    $sellerIndicator->setComputationDate($sellerIndicatorXML['ComputationDate']);
                }
                if (isset($sellerIndicatorXML['Description']) && !SoapTools::isSoapValueNull($sellerIndicatorXML['Description'])) {
                    $sellerIndicator->setDescription($sellerIndicatorXML['Description']);
                }
                if (isset($sellerIndicatorXML['Threshold']) && !SoapTools::isSoapValueNull($sellerIndicatorXML['Threshold'])) {
                    $sellerIndicator->setThreshold(floatval($sellerIndicatorXML['Threshold']));
                }
                if (isset($sellerIndicatorXML['ThresholdType']) && !SoapTools::isSoapValueNull($sellerIndicatorXML['ThresholdType'])) {
                    $sellerIndicator->setThresholdType($sellerIndicatorXML['ThresholdType']);
                }
                if (isset($sellerIndicatorXML['ValueD30']) && !SoapTools::isSoapValueNull($sellerIndicatorXML['ValueD30'])) {
                    $sellerIndicator->setValueD30(floatval(['ValueD30']));
                }
                if (isset($sellerIndicatorXML['ValueD60']) && !SoapTools::isSoapValueNull($sellerIndicatorXML['ValueD60'])) {
                    $sellerIndicator->setValueD60(floatval($sellerIndicatorXML['ValueD60']));
                }

                array_push($this->_sellerIndicators, $sellerIndicator);
            }

        }
    }


}