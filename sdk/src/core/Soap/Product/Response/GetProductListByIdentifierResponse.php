<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 16:47
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\ProductIdentity;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class GetProductListByIdentifierResponse extends iResponse
{
    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_productList = null;

    /**
     * GetProductListByIdentifierResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check For error message
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['GetProductListByIdentifierResponse']['GetProductListByIdentifierResult']))
        {
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
        $objInfoResult = $this->_dataResponse['s:Body']['GetProductListByIdentifierResponse']['GetProductListByIdentifierResult'];
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
        $objError = $this->_dataResponse['s:Body']['GetProductListByIdentifierResponse']['GetProductListByIdentifierResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

    /**
     * Get product list
     */
    private function _getProductList()
    {
        foreach ($this->_dataResponse['s:Body']['GetProductListByIdentifierResponse']['GetProductListByIdentifierResult']['a:ProductListByIdentifier']['a:ProductByIdentifier'] as $productXML) {                 
           
            $product = new ProductIdentity($productXML['a:Ean']);                
            if($productXML['a:HasError'] == 'true')
            {
                if (isset($productXML['a:HasError']) && !SoapTools::isSoapValueNull($productXML['a:HasError'])) 
                {
                    $product->setHasError($productXML['a:HasError']);  
                }

                if (isset($productXML['a:ErrorMessage']) && !SoapTools::isSoapValueNull($productXML['a:ErrorMessage'])) 
                {
                    $product->setErrorMessage($productXML['a:ErrorMessage']);
                } 
            }
            else
            {
                if (isset($productXML['a:BrandName']) && !SoapTools::isSoapValueNull($productXML['a:BrandName'])) 
                {
                    $product->setBrandName($productXML['a:BrandName']);  
                }

                if (isset($productXML['a:CategoryCode']) && !SoapTools::isSoapValueNull($productXML['a:CategoryCode'])) 
                {
                    $product->setCategoryCode($productXML['a:CategoryCode']);
                }

                if (isset($productXML['a:Name']) && !SoapTools::isSoapValueNull($productXML['a:Name'])) 
                {
                    $product->setName($productXML['a:Name']);
                }

                if (isset($productXML['a:FatherProductId']) && !SoapTools::isSoapValueNull($productXML['a:FatherProductId'])) 
                {
                    $product->setFatherProductId($productXML['a:FatherProductId']); 
                }

                if (isset($productXML['a:ImageUrl']) && !SoapTools::isSoapValueNull($productXML['a:ImageUrl'])) 
                {
                    $product->setImageURL($productXML['a:ImageUrl']);
                }

                if (isset($productXML['a:ProductType']) && !SoapTools::isSoapValueNull($productXML['a:ProductType'])) 
                {
                    $product->setProductType($productXML['a:ProductType']);
                }

                if(isset($productXML['a:Color']) && !SoapTools::isSoapValueNull($productXML['a:Color']) && !is_array($productXML['a:Color']))
                {
                    $product->setColor($productXML['a:Color']);
                }
                else
                {
                    $product->setColor('-');
                }

                if(isset($productXML['a:Size']) && !SoapTools::isSoapValueNull($productXML['a:Size']) && !is_array($productXML['a:Size']))
                {
                    $product->setSize($productXML['a:Size']);
                }
                else
                {
                    $product->setSize('-');
                }
            }

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
}