<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 09:31
 */

namespace Sdk\Soap\Offer\Response;


class GetOfferListPaginatedResponse extends GetOfferListGenericResponse
{

    /**
     * @var int
     */
    private $_currentPageNumber = 0;

    /**
     * @return int
     */
    public function getCurrentPageNumber()
    {
        return $this->_currentPageNumber;
    }

    /**
     * @var int
     */
    private $_numberOfPages = 0;

    /**
     * @return int
     */
    public function getNumberOfPages()
    {
        return $this->_numberOfPages;
    }

    /**
     * GetOfferListPaginatedResponse constructor.
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
            $this->_setOfferListFromXML($this->_dataResponse['s:Body']['GetOfferListPaginatedResponse']['GetOfferListPaginatedResult']['OfferList']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOfferListPaginatedResponse']['GetOfferListPaginatedResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
        $this->_currentPageNumber = $objInfoResult['CurrentPageNumber'];
        $this->_numberOfPages = $objInfoResult['NumberOfPages'];
    }

    /**
     * Check if the response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOfferListPaginatedResponse']['GetOfferListPaginatedResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
}