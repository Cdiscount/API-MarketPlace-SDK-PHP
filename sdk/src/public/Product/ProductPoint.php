<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:03
 */

namespace Sdk\Product;

use Sdk\AbstractPoint;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Product\GetAllAllowedCategoryTree;
use Sdk\Soap\Product\GetAllModelList;
use Sdk\Soap\Product\GetAllowedCategoryTree;
use Sdk\Soap\Product\GetBrandList;
use Sdk\Soap\Product\GetModelList;
use Sdk\Soap\Product\GetProductList;
use Sdk\Soap\Product\GetProductListByIdentifier;
use Sdk\Soap\Product\GetProductPackageProductMatchingFileData;
use Sdk\Soap\Product\GetProductPackageSubmissionResult;
use Sdk\Soap\Product\ModelFilterSoap;
use Sdk\Soap\Product\ProductFilterSoap;
use Sdk\Soap\Product\IdentifierRequestSoap;
use Sdk\Soap\Product\Response\GetAllAllowedCategoryTreeResponse;
use Sdk\Soap\Product\Response\GetAllModelListResponse;
use Sdk\Soap\Product\Response\GetAllowedCategoryTreeResponse;
use Sdk\Soap\Product\Response\GetBrandListResponse;
use Sdk\Soap\Product\Response\GetModelListResponse;
use Sdk\Soap\Product\Response\GetProductListResponse;
use Sdk\Soap\Product\Response\GetProductListByIdentifierResponse;
use Sdk\Soap\Product\Response\GetProductPackageProductMatchingFileDataResponse;
use Sdk\Soap\Product\Response\GetProductPackageSubmissionResultResponse;
use Sdk\Soap\Product\Response\SubmitProductPackageResponse;
use Sdk\Soap\Product\SubmitProductPackage;

/*
 * Product point
 */
class ProductPoint extends AbstractPoint
{
    /**
     * @return GetProductListByIdentifierResponse
     */
    public function getProductListByIdentifier($identifierRequest)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getProductListByIdentifier = new GetProductListByIdentifier();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $identifierRequestSoap = new IdentifierRequestSoap($identifierRequest);
        $productFilterSoapXml = $identifierRequestSoap->serialize();

        $getProductListByIdentifierXML = $getProductListByIdentifier->generateEnclosingBalise($headerXML . $productFilterSoapXml);
        $bodyXML = $body->generateXML($getProductListByIdentifierXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetProductListByIdentifier', $envelopeXML);

        return new GetProductListByIdentifierResponse($response);
    }

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

        $response = $this->_sendRequest('GetProductList', $envelopeXML);

        return new GetProductListResponse($response);
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

        $response = $this->_sendRequest('GetAllowedCategoryTree', $envelopeXML);

        return new GetAllowedCategoryTreeResponse($response);
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

        $response = $this->_sendRequest('GetAllAllowedCategoryTree', $envelopeXML);

        return new GetAllAllowedCategoryTreeResponse($response);
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

        return new GetModelListResponse($response);
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

        $response = $this->_sendRequest('GetAllModelList', $envelopeXML);

        return new GetAllModelListResponse($response);
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

        $response = $this->_sendRequest('GetBrandList', $envelopeXML);

        return new GetBrandListResponse($response);
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

        return new SubmitProductPackageResponse($response);
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

        return new GetProductPackageSubmissionResultResponse($response);
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

        $response = $this->_sendRequest('GetProductPackageProductMatchingFileData', $envelopeXML);

        return new GetProductPackageProductMatchingFileDataResponse($response);
    }
}