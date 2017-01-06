<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 16:47
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\Product;
use Sdk\Soap\Common\iResponse;

class GetProductListResponse extends iResponse
{
    /**
     * @var array|bool|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_productList = null;

    /**
     * GetProductListResponse constructor.
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
            $this->_productList = array();

            $this->_getProductList();
        }
    }

    /**
     * Set Token ID and Seller Login from XML response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetProductListResponse']['GetProductListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }
    /**
     * Check if the XML response has an error message
     *
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetProductListResponse']['GetProductListResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

    private function _getProductList()
    {
        foreach ($this->_dataResponse['s:Body']['GetProductListResponse']['GetProductListResult']['ProductList']['Product'] as $productXML) {

            $product = new Product($productXML['SKU']);
            $product->setBrandName($productXML['BrandName']);

            if (isset($productXML['EANList']['a:string'])) {
                $product->setEANList($productXML['EANList']['a:string']);
            }
            $product->setName($productXML['Name']);
            $product->setProductType($productXML['ProductType']);

            array_push($this->_productList, $product);
        }
    }

    /**
     * @return array \Sdk\Product\Product
     */
    public function getProductList()
    {
        return $this->_productList;
    }

    /**
     * Get products by name
     *
     * @param $name
     * @return array
     */
    public function getProductsByName($name)
    {
        $newList = array();

        /** @var \Sdk\Product\Product $product */
        foreach ($this->_productList as $product) {
            if ($product->getName() == $name) {
                array_push($newList, $product);
            }
        }

        return $newList;
    }

    /**
     * Get Products by brand name
     *
     * @param $brand
     * @return array
     */
    public function getProductsByBrand($brand)
    {
        $newList = array();

        /** @var \Sdk\Product\Product $product */
        foreach ($this->_productList as $product) {
            if ($product->getBrandName() == $brand) {
                array_push($newList, $product);
            }
        }

        return $newList;
    }

    /**
     * Get product by SKU
     *
     * @param $sku
     * @return null|Product
     */
    public function getProductBySku($sku)
    {
        /** @var \Sdk\Product\Product $product */
        foreach ($this->_productList as $product) {
            if ($product->getSKU() == $sku) {
                return $product;
            }
        }
        return null;
    }
}