<?php
/**
 * Created by Cdiscount.
 * Date: 02/12/2016
 * Time: 15:04
 */


namespace Sdk\Soap\Relays\Response;

use Sdk\Soap\Common\iResponse;

class GetParcelShopListResponse extends iResponse
{

    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_parcelShopList = null;

    /**
     * @return array
     */
    public function getParcelShopList()
    {
        return $this->_parcelShopList;
    }

    /**
     * GetParcelShopListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_parcelShopList = array();

            $this->_generateParcelShopListFromXML($this->_dataResponse['s:Body']['GetParcelShopListResponse']['GetParcelShopListResult']['ParcelShopList']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetParcelShopListResponse']['GetParcelShopListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetParcelShopListResponse']['GetParcelShopListResult']['ErrorMessage'];
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
     * @param $parcelShopListXML
     */
    private function _generateParcelShopListFromXML($parcelShopListXML)
    {
        $manyParcels = true;
        foreach ($parcelShopListXML['ParcelShop'] as $parcelShopXML) {

            if (!isset($parcelShopXML['City'])) {
                $manyParcels = false;
                break;
            }
            $message = new Message();
            if (isset($messageXML['Content'])) {
                $message->setContent($messageXML['Content']);
            }
            if (isset($messageXML['Sender'])) {
                $message->setSender($messageXML['Sender']);
            }
            if (isset($messageXML['Timestamp'])) {
                $message->setTimestamp($messageXML['Timestamp']);
            }
            $offerQuestion->addMessageToList($message);
        }

        if (!$manyParcels) {

            $message = new Message();
            $message->setContent($questionXML['Messages']['Message']['Content']);
            $message->setSender($questionXML['Messages']['Message']['Sender']);
            $message->setTimestamp($questionXML['Messages']['Message']['Timestamp']);
            $offerQuestion->addMessageToList($message);
        }

        array_push($this->_offerQuestionList, $offerQuestion);
    }


}