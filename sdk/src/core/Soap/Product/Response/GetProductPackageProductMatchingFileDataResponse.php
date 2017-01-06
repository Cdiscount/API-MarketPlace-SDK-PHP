<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 15/11/2016
 * Time: 15:46
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\Product;
use Sdk\Product\ProductMatching;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class GetProductPackageProductMatchingFileDataResponse extends iResponse
{
    /**
     * @var array|bool|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_productMatchingList = null;

    /**
     * @return array
     */
    public function getProductMatchingList()
    {
        return $this->_productMatchingList;
    }

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
     * GetProductPackageProductMatchingFileDataResponse constructor.
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

            /**
             * Product List
             */
            $this->_productMatchingList = array();

            /** Parse product matching list from XML */
            $this->_getProductMatchingList($this->_dataResponse['s:Body']['GetProductPackageProductMatchingFileDataResponse']['GetProductPackageProductMatchingFileDataResult']);
        }
    }

    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetProductPackageProductMatchingFileDataResponse']['GetProductPackageProductMatchingFileDataResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
        $this->_packageId = intval($objInfoResult['PackageId']);
    }
    /**
     * Check if the XML response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetProductPackageProductMatchingFileDataResponse']['GetProductPackageProductMatchingFileDataResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

    /**
     * @param $result
     */
    private function _getProductMatchingList($result)
    {
        if (isset($result['ProductMatchingList']) && !SoapTools::isSoapValueNull($result['ProductMatchingList']) && isset($result['ProductMatchingList']['ProductMatching'])) {
            foreach ($result['ProductMatchingList']['ProductMatching'] as $productXML) {

                $product = new ProductMatching($productXML['SKU']);

                if (isset($productXML['Color']) && !SoapTools::isSoapValueNull($productXML['Color'])) {
                    $product->setColor($productXML['Color']);
                }
                if (isset($productXML['Comment']) && !SoapTools::isSoapValueNull($productXML['Comment'])) {
                    $product->setComment($productXML['Comment']);
                }
                if (isset($productXML['Ean']) && !SoapTools::isSoapValueNull($productXML['Ean'])) {
                    $product->setEan($productXML['Ean']);
                }
                if (isset($productXML['Name']) && !SoapTools::isSoapValueNull($productXML['Name'])) {
                    $product->setName($productXML['Name']);
                }
                if (isset($productXML['SellerProductId']) && !SoapTools::isSoapValueNull($productXML['SellerProductId'])) {
                    $product->setSellerProductId($productXML['SellerProductId']);
                }
                if (isset($productXML['Size']) && !SoapTools::isSoapValueNull($productXML['Size'])) {
                    $product->setSize($productXML['Size']);
                }
                if (isset($productXML['MatchingStatus']) && !SoapTools::isSoapValueNull($productXML['MatchingStatus'])) {
                    $product->setMatchingStatus($productXML['MatchingStatus']);
                }
                array_push($this->_productMatchingList, $product);
            }
        }
    }
}