<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:03
 */

namespace Sdk\Product;


use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Product\GetAllAllowedCategoryTree;
use Sdk\Soap\Product\GetAllModelList;
use Sdk\Soap\Product\GetAllowedCategoryTree;
use Sdk\Soap\Product\GetBrandList;
use Sdk\Soap\Product\GetModelList;
use Sdk\Soap\Product\GetProductList;
use Sdk\Soap\Product\GetProductPackageProductMatchingFileData;
use Sdk\Soap\Product\GetProductPackageSubmissionResult;
use Sdk\Soap\Product\ModelFilterSoap;
use Sdk\Soap\Product\ProductFilterSoap;
use Sdk\Soap\Product\Response\GetAllAllowedCategoryTreeResponse;
use Sdk\Soap\Product\Response\GetAllModelListResponse;
use Sdk\Soap\Product\Response\GetAllowedCategoryTreeResponse;
use Sdk\Soap\Product\Response\GetBrandListResponse;
use Sdk\Soap\Product\Response\GetModelListResponse;
use Sdk\Soap\Product\Response\GetProductListResponse;
use Sdk\Soap\Product\Response\GetProductPackageProductMatchingFileDataResponse;
use Sdk\Soap\Product\Response\GetProductPackageSubmissionResultResponse;
use Sdk\Soap\Product\Response\SubmitProductPackageResponse;
use Sdk\Soap\Product\SubmitProductPackage;

class ProductPoint
{

    /**
     * @param $productFilter \Sdk\Product\ProductFilter
     * @return GetProductListResponse
     */
    public function getProductList($productFilter)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getProductList = new GetProductList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $productFilterSoap = new ProductFilterSoap($productFilter);
        $productFilterSoapXml = $productFilterSoap->serialize();
        $getProductListXML = $getProductList->generateEnclosingBalise($headerXML . $productFilterSoapXml);
        $bodyXML = $body->generateXML($getProductListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetProductList', $envelopeXML);

        $getProductListResponse = new GetProductListResponse($response);
        return $getProductListResponse;
    }

    /**
     * @return \Sdk\Soap\Product\Response\GetAllowedCategoryTreeResponse
     */
    public function getAllowedCategoryTree()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getAllowedCategoryTree = new GetAllowedCategoryTree();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $allowedCategoryTreeXML = $getAllowedCategoryTree->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($allowedCategoryTreeXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetAllowedCategoryTree', $envelopeXML);

        $allowedCategoryTreeResponse = new GetAllowedCategoryTreeResponse($response);

        return $allowedCategoryTreeResponse;
    }

    /**
     * @return GetAllAllowedCategoryTreeResponse
     */
    public function getAllAllowedCategoryTree()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getAllowedCategoryTree = new GetAllAllowedCategoryTree();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $allowedCategoryTreeXML = $getAllowedCategoryTree->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($allowedCategoryTreeXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetAllAllowedCategoryTree', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $allowedCategoryTreeResponse = new GetAllAllowedCategoryTreeResponse($response);

        return $allowedCategoryTreeResponse;
    }

    /**
     * @param $modelFilter \Sdk\Product\ModelFilter
     * @return GetModelListResponse
     */
    public function getModelList($modelFilter)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getModelList = new GetModelList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $modelFilterSoap = new ModelFilterSoap($modelFilter);
        $modelFilterSoapXml = $modelFilterSoap->serialize();
        $getModelListXML = $getModelList->generateEnclosingBalise($headerXML . $modelFilterSoapXml);
        $bodyXML = $body->generateXML($getModelListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetModelList', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getModelListResponse = new GetModelListResponse($response);
        return $getModelListResponse;
    }

    /**
     * @return GetAllModelListResponse
     */
    public function getAllModelList()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getAllModelList = new GetAllModelList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $getModelListXML = $getAllModelList->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($getModelListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetAllModelList', $envelopeXML);

        echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getAllModelListResponse = new GetAllModelListResponse($response);

        return $getAllModelListResponse;
        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
    }

    /**
     * This method returns the complete brand list
     */
    public function getBrandList()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getBrandList = new GetBrandList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $getBrandListXML = $getBrandList->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($getBrandListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetBrandList', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getBrandListResponse = new GetBrandListResponse($response);

        return $getBrandListResponse;
    }

    /**
     * @param $zipURL string ZipArchiveURL
     * @return SubmitProductPackageResponse
     */
    public function submitProductPackage($zipURL)
    {
        $envelope = new Envelope();
        $body = new Body();
        $submitProductPackage = new SubmitProductPackage();
        $header = new HeaderMessage();

        $submitRequestXML = $submitProductPackage->generatePackageRequestXML($zipURL);

        $headerXML = $header->generateHeader();
        $submitProductPackageXML = $submitProductPackage->generateEnclosingBalise($headerXML . $submitRequestXML);
        $bodyXML = $body->generateXML($submitProductPackageXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('SubmitProductPackage', $envelopeXML);

        $submitProductPackageResponse = new SubmitProductPackageResponse($response);
        return $submitProductPackageResponse;
    }

    /**
     * @param $packageId integer
     * @return GetProductPackageSubmissionResultResponse
     */
    public function getProductPackageSubmissionResult($packageId)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getProductPackageSubmissionResult = new GetProductPackageSubmissionResult();
        $header = new HeaderMessage();

        $productPackageFilterXML = $getProductPackageSubmissionResult->generatePackageFilterXML($packageId);

        $headerXML = $header->generateHeader();
        $submitProductPackageXML = $getProductPackageSubmissionResult->generateEnclosingBalise($headerXML . $productPackageFilterXML);
        $bodyXML = $body->generateXML($submitProductPackageXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetProductPackageSubmissionResult', $envelopeXML);

        $getProductPackageSubmissionResultResponse = new GetProductPackageSubmissionResultResponse($response);
        return $getProductPackageSubmissionResultResponse;
    }

    /**
     * @param $packageId
     * @return GetProductPackageProductMatchingFileDataResponse
     */
    public function getProductPackageProductMatchingFileData($packageId)
    {
        $envelope = new Envelope();
        $body = new Body();

        $getProductPackageSubmissionResult = new GetProductPackageProductMatchingFileData();
        $header = new HeaderMessage();

        $productPackageFilterXML = $getProductPackageSubmissionResult->generatePackageFilterXML($packageId);

        $headerXML = $header->generateHeader();
        $submitProductPackageXML = $getProductPackageSubmissionResult->generateEnclosingBalise($headerXML . $productPackageFilterXML);
        $bodyXML = $body->generateXML($submitProductPackageXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetProductPackageProductMatchingFileData', $envelopeXML);

        echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getProductPackageProductMatchingFileDataResponse = new GetProductPackageProductMatchingFileDataResponse($response);

        return $getProductPackageProductMatchingFileDataResponse;
    }

    /**
     * @param $method
     * @param $data
     * @return mixed
     */
    private function _sendRequest($method, $data)
    {
        $headerRequestURL = ConfigFileLoader::getInstance()->getConfAttribute('methodurl');

        $apiURL = ConfigFileLoader::getInstance()->getConfAttribute('url');

        $request = new CDSApiSoapRequest($method, $headerRequestURL, $apiURL, $data);
        $response = $request->call();

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        return $response;
    }


}