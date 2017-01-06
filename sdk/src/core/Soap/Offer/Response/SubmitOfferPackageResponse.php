<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 15:23
 */

namespace Sdk\Soap\Offer\Response;


use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class SubmitOfferPackageResponse extends iResponse
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
     * SubmitOfferPackageResponse constructor.
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

            $this->_setImportInformationsFromXML($this->_dataResponse['s:Body']['SubmitOfferPackageResponse']['SubmitOfferPackageResult']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['SubmitOfferPackageResponse']['SubmitOfferPackageResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['SubmitOfferPackageResponse']['SubmitOfferPackageResult']['ErrorMessage'];
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

        if (isset($submitProductPackageResult['PackageIntegrationStatus']) && !SoapTools::isSoapValueNull($submitProductPackageResult['PackageIntegrationStatus'])) {
            $this->_packageIntegrationStatus = $submitProductPackageResult['PackageIntegrationStatus'];
        }
        if (isset($submitProductPackageResult['ProductLogList']) && !SoapTools::isSoapValueNull($submitProductPackageResult['ProductLogList'])) {
            $this->_productLogList = $submitProductPackageResult['ProductLogList'];
        }
    }
}