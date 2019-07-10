<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 17:50
 */

namespace Sdk\Soap\Offer\Response;


use Sdk\Offer\OfferReportLog;
use Sdk\Offer\OfferReportPropertyLog;
use Sdk\Soap\Common\iResponse;

class GetOfferPackageSubmissionResultResponse extends iResponse
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
    private $_offerLogList = null;

    /**
     * @return array
     */
    public function getOfferLogList()
    {
        return $this->_offerLogList;
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

        $this->_offerLogList = array();

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            if (isset($this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult']['OfferLogList'])) {
                $this->_setImportInformationsFromXML($this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult']['OfferLogList']);
            }
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
        $this->_packageId = $objInfoResult['PackageId'];
        $this->_packageIntegrationStatus = $objInfoResult['PackageIntegrationStatus'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOfferPackageSubmissionResultResponse']['GetOfferPackageSubmissionResultResult']['ErrorMessage'];
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
     * @param $offerLogXML
     */
    private function _setImportInformationsFromXML($offerLogXML)
    {
        if (!isset($offerLogXML['OfferReportLog'])) {
            return;
        }

        if (array_key_exists('LogDate', $offerLogXML['OfferReportLog'])) {
            $offerLogXML['OfferReportLog'] = [$offerLogXML['OfferReportLog']];
        }

        foreach ($offerLogXML['OfferReportLog'] as $reportXML) {

            $offerReportLog = new OfferReportLog();

            /** LogDate */
            $offerReportLog->setLogDate($reportXML['LogDate']);

            /** ProductIntegrationStatus */
            $offerReportLog->setOfferIntegrationStatus($reportXML['OfferIntegrationStatus']);

            /** Product EAN */
            $offerReportLog->setProductEan($reportXML['ProductEan']);

            $offerReportPropertyLog = $reportXML['PropertyList']['OfferReportPropertyLog'];

            if (is_array($offerReportPropertyLog)) {

                if (array_key_exists('LogMessage', $offerReportPropertyLog)) {
                    $offerReportPropertyLog = [$offerReportPropertyLog];
                }

                foreach ($offerReportPropertyLog as $key => $log) {
                    /** PropertyList - ProductReportPropertyLog */
                    $offerReportPropertyLog = new OfferReportPropertyLog($log['PropertyCode']);
                    $offerReportPropertyLog->setLogMessage($log['LogMessage']);
                    $offerReportPropertyLog->setName($log['Name']);
                    $offerReportPropertyLog->setPropertyError($log['PropertyError']);

                    $offerReportLog->addOfferReportPropertyLog($offerReportPropertyLog);
                }
            }

            /** Seller Product ID */
            $offerReportLog->setSellerProductId($reportXML['SellerProductId']);

            /** SKU */
            if (isset($reportXML['Sku'])) {
                $offerReportLog->setSKU($reportXML['Sku']);
            }

            /** Validated */
            if ($reportXML['Validated'] == 'true') {
                $offerReportLog->setValidated(true);
            }

            array_push($this->_offerLogList, $offerReportLog);
        }
    }
}
