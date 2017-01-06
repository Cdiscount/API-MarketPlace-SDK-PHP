<?php
/**
 * Created by Cdiscount.
 * Date: 01/12/2016
 * Time: 15:46
 */

namespace Sdk\Soap\Order\Response;

use Sdk\Delivey\Carrier;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class GetGlobalConfigurationResponse extends iResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_carrierList = null;

    /**
     * @return array
     */
    public function getCarrierList()
    {
        return $this->_carrierList;
    }

    /**
     * GetGlobalConfigurationResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        $this->_carrierList = array();

        /** Check For error message */
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_carrierList = array();

            $this->_getCarrierListFromXML($this->_dataResponse['s:Body']['GetGlobalConfigurationResponse']['GetGlobalConfigurationResult']['CarrierList']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetGlobalConfigurationResponse']['GetGlobalConfigurationResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetGlobalConfigurationResponse']['GetGlobalConfigurationResult']['ErrorMessage'];
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
     * @param $carrierListXML
     */
    private function _getCarrierListFromXML($carrierListXML)
    {
        foreach ($carrierListXML['Carrier'] as $carrierXML) {

            if (isset($carrierXML['CarrierId']) && !SoapTools::isSoapValueNull($carrierXML['CarrierId'])) {

                $carrier = new Carrier($carrierXML['CarrierId']);
                if (isset($carrierXML['DefaultURL']) && !SoapTools::isSoapValueNull($carrierXML['DefaultURL'])) {
                    $carrier->setDefaultURL($carrierXML['DefaultURL']);
                }
                if (isset($carrierXML['Name']) && !SoapTools::isSoapValueNull($carrierXML['Name'])) {
                    $carrier->setName($carrierXML['Name']);
                }

                array_push($this->_carrierList, $carrier);
            }
        }
    }
}