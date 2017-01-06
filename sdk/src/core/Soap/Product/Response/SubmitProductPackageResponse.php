<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 13:25
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class SubmitProductPackageResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var int
     */
    private $_packageId = 0;

    /**
     * @return int
     */
    public function getPackageId()
    {
        return $this->_packageId;
    }

    /**
     * @var string
     */
    private $_packageIntegrationStatus = null;

    /**
     * @return string
     */
    public function getPackageIntegrationStatus()
    {
        return $this->_packageIntegrationStatus;
    }

    /**
     * @var array
     */
    private $_productLogList = null;

    /**
     * @return array
     */
    public function getProductLogList()
    {
        return $this->_productLogList;
    }

    /**
     * SubmitProductPackageResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        $this->_productLogList = array();

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_setImportInformationsFromXML($this->_dataResponse['s:Body']['SubmitProductPackageResponse']['SubmitProductPackageResult']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitProductPackageResponse']['SubmitProductPackageResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['SubmitProductPackageResponse']['SubmitProductPackageResult']['ErrorMessage'];
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
     * @param $submitProductPackageResult
     */
    private function _setImportInformationsFromXML($submitProductPackageResult)
    {
        $this->_packageId = $submitProductPackageResult['PackageId'];

        if (!SoapTools::isSoapValueNull($submitProductPackageResult['PackageIntegrationStatus'])) {
            $this->_packageIntegrationStatus = $submitProductPackageResult['PackageIntegrationStatus'];
        }
        if (!SoapTools::isSoapValueNull($submitProductPackageResult['ProductLogList'])) {
            $this->_productLogList = $submitProductPackageResult['ProductLogList'];
        }
    }
}