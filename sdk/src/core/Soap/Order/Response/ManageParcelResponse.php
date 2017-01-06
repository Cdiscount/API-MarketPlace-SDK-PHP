<?php
/**
 * Created by Cdiscount.
 * Date: 13/12/2016
 * Time: 16:44
 */


namespace Sdk\Soap\Order\Response;

use Sdk\Order\ParcelActionResult;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class ManageParcelResponse extends iResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_parcelActionResultList = null;

    /**
     * @return array
     */
    public function getParcelActionResultList()
    {
        return $this->_parcelActionResultList;
    }

    /**
     * ManageParcelResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        /** Check For error message */
        if (!$this->_hasErrorMessage()) {

            $this->_parcelActionResultList = array();

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_generateParcelActionResultList($this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult']['ParcelActionResultList']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult']['ErrorMessage'];
        $this->_errorList = array();

        if ($this->_dataResponse['s:Body']['ManageParcelResponse']['ManageParcelResult']['OperationSuccess']['_'] == 'true') {
            $this->_operationSuccess = true;
        }

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            array_push($this->_errorList, $this->_errorMessage);
            return true;
        }
        return false;
    }

    /**
     * @param $parcelActionResultList
     */
    private function _generateParcelActionResultList($parcelActionResultList)
    {
        $manyparcels = true;
        foreach ($parcelActionResultList['ParcelActionResult'] as $parcelActionXML) {

            if (!isset($parcelActionXML['ActionType'])) {
                $manyparcels = false;
                break;
            }

            $parcelActionResult = new ParcelActionResult();

            if (isset($parcelActionXML['ErrorMessage']) && !SoapTools::isSoapValueNull($parcelActionXML['ErrorMessage'])) {
                $parcelActionResult->setErrorMessage($parcelActionXML['ErrorMessage']);
                $parcelActionResult->addErrorToList($parcelActionXML['ErrorMessage']);
            }

            if (isset($parcelActionXML['ActionType']) && !SoapTools::isSoapValueNull($parcelActionXML['ActionType'])) {
                $parcelActionResult->setActionType($parcelActionXML['ActionType']);
            }

            if (isset($parcelActionXML['ParcelNumber']) && !SoapTools::isSoapValueNull($parcelActionXML['ParcelNumber'])) {
                $parcelActionResult->setParcelNumber($parcelActionXML['ParcelNumber']);
            }

            if (isset($parcelActionXML['ErrorMessage']) && !SoapTools::isSoapValueNull($parcelActionXML['ErrorMessage'])) {
                $parcelActionResult->setErrorMessage($parcelActionXML['ErrorMessage']);
            }

            if (isset($parcelActionXML['TokenId']) && !SoapTools::isSoapValueNull($parcelActionXML['TokenId'])) {
                $parcelActionResult->setTokenId($parcelActionXML['TokenId']);
            }

            if (isset($parcelActionXML['IsActionCreated']) && !SoapTools::isSoapValueNull($parcelActionXML['IsActionCreated']) && $parcelActionXML['IsActionCreated'] == 'true') {
                $parcelActionResult->setActionCreated(true);
            }

            if (isset($parcelActionXML['OperationSuccess']['_']) && $parcelActionXML['OperationSuccess']['_'] == 'true') {

                $parcelActionResult->setOperationSuccess(true);
            }

            if (isset($parcelActionXML['SellerLogin']) && !SoapTools::isSoapValueNull($parcelActionXML['SellerLogin'])) {
                $parcelActionResult->setSellerLogin($parcelActionXML['SellerLogin']);
            }
            array_push($this->_parcelActionResultList, $parcelActionResult);
        }

        if (!$manyparcels) {
            $parcelActionResult = new ParcelActionResult();

            if (isset($parcelActionResultList['ParcelActionResult']['ErrorMessage']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['ErrorMessage'])) {
                $parcelActionResult->setErrorMessage($parcelActionResultList['ParcelActionResult']['ErrorMessage']);
                $parcelActionResult->addErrorToList($parcelActionResultList['ParcelActionResult']['ErrorMessage']);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['ActionType']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['ActionType'])) {
                $parcelActionResult->setActionType($parcelActionResultList['ParcelActionResult']['ActionType']);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['ParcelNumber']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['ParcelNumber'])) {
                $parcelActionResult->setParcelNumber($parcelActionResultList['ParcelActionResult']['ParcelNumber']);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['ErrorMessage']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['ErrorMessage'])) {
                $parcelActionResult->setErrorMessage($parcelActionResultList['ParcelActionResult']['ErrorMessage']);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['TokenId']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['TokenId'])) {
                $parcelActionResult->setTokenId($parcelActionResultList['ParcelActionResult']['TokenId']);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['IsActionCreated']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['IsActionCreated']) && $parcelActionResultList['ParcelActionResult']['IsActionCreated'] == 'true') {
                $parcelActionResult->setActionCreated(true);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['OperationSuccess']['_']) && $parcelActionResultList['ParcelActionResult']['OperationSuccess']['_'] == 'true') {

                $parcelActionResult->setOperationSuccess(true);
            }

            if (isset($parcelActionResultList['ParcelActionResult']['SellerLogin']) && !SoapTools::isSoapValueNull($parcelActionResultList['ParcelActionResult']['SellerLogin'])) {
                $parcelActionResult->setSellerLogin($parcelActionResultList['ParcelActionResult']['SellerLogin']);
            }
            array_push($this->_parcelActionResultList, $parcelActionResult);
        }
    }
}