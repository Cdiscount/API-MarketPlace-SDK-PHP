<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 11:36
 */

namespace Sdk\Soap\Offer\Response;


class GetOfferListResponse extends GetOfferListGenericResponse
{
    /**
     * GetOfferListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        parent::__construct($response);

        /** Check for error message */
        if (!$this->_hasErrorMessage()) {

            /** Global informations */
            $this->_setGlobalInformations();

            /** Parse offer list */
            if (isset($this->_dataResponse['s:Body']['GetOfferListResponse']['GetOfferListResult']['OfferList']) 
                && isset($this->_dataResponse['s:Body']['GetOfferListResponse']['GetOfferListResult']['OfferList']['Offer'])) {
                $this->_setOfferListFromXML($this->_dataResponse['s:Body']['GetOfferListResponse']['GetOfferListResult']['OfferList']);
            }
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOfferListResponse']['GetOfferListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOfferListResponse']['GetOfferListResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
}