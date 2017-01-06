<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:26
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\CategoryTree;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;
use SimpleXMLElement;

class GetAllowedCategoryTreeResponse extends GetGenericCategoryTreeResponse
{
    /**
     * GetAllowedCategoryTreeResponse constructor.
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

            $this->_addRootCategoryTree($this->_dataResponse['s:Body']['GetAllowedCategoryTreeResponse']['GetAllowedCategoryTreeResult']['CategoryTree']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetAllowedCategoryTreeResponse']['GetAllowedCategoryTreeResult'];
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
        $objError = $this->_dataResponse['s:Body']['GetAllowedCategoryTreeResponse']['GetAllowedCategoryTreeResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
}