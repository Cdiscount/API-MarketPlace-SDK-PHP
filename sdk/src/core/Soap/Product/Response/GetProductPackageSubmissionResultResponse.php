<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 15:23
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\ProductReportLog;
use Sdk\Product\ProductReportPropertyLog;
use Sdk\Soap\Common\iResponse;

class GetProductPackageSubmissionResultResponse extends iResponse
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
     * @var bool
     */
    private $_packageImportHasErrors = false;

    /**
     * @return boolean
     */
    public function isPackageImportHasErrors()
    {
        return $this->_packageImportHasErrors;
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

            if (!isset($this->_dataResponse['s:Body']['GetProductPackageSubmissionResultResponse']['GetProductPackageSubmissionResultResult']['ProductLogList']['ProductReportLog'])) {
                $this->_setImportInformationsFromXML($this->_dataResponse['s:Body']['GetProductPackageSubmissionResultResponse']['GetProductPackageSubmissionResultResult']);
            }
            else {
                $this->_packageImportHasErrors = true;
                $this->_setImportErrorsFromXML($this->_dataResponse['s:Body']['GetProductPackageSubmissionResultResponse']['GetProductPackageSubmissionResultResult']['ProductLogList']);
            }
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetProductPackageSubmissionResultResponse']['GetProductPackageSubmissionResultResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetProductPackageSubmissionResultResponse']['GetProductPackageSubmissionResultResult']['ErrorMessage'];
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
     * @param $productLogXML
     */
    private function _setImportErrorsFromXML($productLogXML)
    {
        $isMul = true;

        foreach ($productLogXML['ProductReportLog'] as $reportXML) {

            if (!isset($reportXML['LogDate'])) {
                $isMul = false;
                break;
            }

        }

        if (!$isMul) {

            $productReportLog = new ProductReportLog();

            /** LogDate */
            $productReportLog->setLogDate($productLogXML['ProductReportLog']['LogDate']);

            /** ProductIntegrationStatus */
            $productReportLog->setProductIntegrationStatus($productLogXML['ProductReportLog']['ProductIntegrationStatus']);

            /** PropertyList - ProductReportPropertyLog */
            $productReportPropertyLog = new ProductReportPropertyLog($productLogXML['ProductReportLog']['PropertyList']['ProductReportPropertyLog']['ErrorCode']);
            $productReportPropertyLog->setLogMessage($productLogXML['ProductReportLog']['PropertyList']['ProductReportPropertyLog']['LogMessage']);
            $productReportPropertyLog->setName($productLogXML['ProductReportLog']['PropertyList']['ProductReportPropertyLog']['Name']);
            $productReportPropertyLog->setPropertyError($productLogXML['ProductReportLog']['PropertyList']['ProductReportPropertyLog']['PropertyError']);
            $productReportLog->addProductReportPropertyLog($productReportPropertyLog);

            /** SKU */
            $productReportLog->setSKU($productLogXML['ProductReportLog']['SKU']);

            /** Validated */
            if ($productLogXML['ProductReportLog']['Validated'] == 'true') {
                $productReportLog->setValidated(true);
            }

            array_push($this->_productLogList, $productReportLog);
        }
    }

    /**
     * @param $getProductPackageSubmissionResultResult
     */
    private function _setImportInformationsFromXML($getProductPackageSubmissionResultResult)
    {
        /** Package Id */
        $this->_packageId = $getProductPackageSubmissionResultResult['PackageId'];

        /** Integration Status */
        $this->_packageIntegrationStatus = $getProductPackageSubmissionResultResult['PackageIntegrationStatus'];
    }
}