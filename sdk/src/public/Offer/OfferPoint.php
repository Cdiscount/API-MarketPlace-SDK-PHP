<?php

namespace Sdk\Offer;
use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Offer\GetAllowedCategoryTree;
use Sdk\Soap\Offer\GetOfferList;
use Sdk\Soap\Offer\GetOfferListPaginated;
use Sdk\Soap\Offer\GetOfferPackageSubmissionResult;
use Sdk\Soap\Offer\OfferFilter;
use Sdk\Soap\Offer\Response\GetOfferListPaginatedResponse;
use Sdk\Soap\Offer\Response\GetOfferListResponse;
use Sdk\Soap\Offer\Response\GetOfferPackageSubmissionResultResponse;
use Sdk\Soap\Offer\Response\SubmitOfferPackageResponse;
use Sdk\Soap\Offer\SubmitOfferPackage;

/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 15:15
 */
class OfferPoint
{

    /**
     * @param $productList
     * @param $offerPoolId
     * @return GetOfferListResponse
     */
    public function getOfferList($productList, $offerPoolId)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getOfferList = new GetOfferList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $offerFilterSoap = new OfferFilter($productList);
        $offerFilterSoap->setOfferPoolId($offerPoolId);
        $offerFilterSoapXml = $offerFilterSoap->serialize();
        $getOfferListXML = $getOfferList->generateEnclosingBalise($headerXML . $offerFilterSoapXml);
        $bodyXML = $body->generateXML($getOfferListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetOfferList', $envelopeXML);

        $getOfferListResponse = new GetOfferListResponse($response);
        return $getOfferListResponse;
    }

    /**
     * @param $offerFilter \Sdk\Offer\OfferFilter
     * @param $offerPoolId
     * @return GetOfferListPaginatedResponse
     */
    public function getOfferListPaginated($offerFilter, $offerPoolId)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getOfferList = new GetOfferListPaginated();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $offerFilterSoap = new OfferFilter(null);
        $offerFilterSoap->setOfferPoolId($offerPoolId);
        $offerFilterSoap->setOfferFilter($offerFilter);
        $offerFilterSoap->setProductList($offerFilter->getProductList());

        $offerFilterSoapXml = $offerFilterSoap->serialize();

        $getOfferListXML = $getOfferList->generateEnclosingBalise($headerXML . $offerFilterSoapXml);
        $bodyXML = $body->generateXML($getOfferListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetOfferListPaginated', $envelopeXML);

        $getOfferListPaginatedResponse = new GetOfferListPaginatedResponse($response);

        return $getOfferListPaginatedResponse;
    }

    /**
     * @param $offerPackageURL
     * @return SubmitOfferPackageResponse
     */
    public function submitOfferPackage($offerPackageURL)
    {
        $envelope = new Envelope();
        $body = new Body();
        $submitProductPackage = new SubmitOfferPackage();
        $header = new HeaderMessage();

        $submitRequestXML = $submitProductPackage->generatePackageRequestXML($offerPackageURL);

        $headerXML = $header->generateHeader();
        $submitProductPackageXML = $submitProductPackage->generateEnclosingBalise($headerXML . $submitRequestXML);
        $bodyXML = $body->generateXML($submitProductPackageXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('SubmitOfferPackage', $envelopeXML);

        $submitProductPackageResponse = new SubmitOfferPackageResponse($response);
        return $submitProductPackageResponse;
    }

    /**
     * @param $packageId
     * @return GetOfferPackageSubmissionResultResponse
     */
    public function getOfferPackageSubmissionResult($packageId)
    {
        $envelope = new Envelope();
        $body = new Body();
        $getProductPackageSubmissionResult = new GetOfferPackageSubmissionResult();
        $header = new HeaderMessage();

        $productPackageFilterXML = $getProductPackageSubmissionResult->generatePackageFilterXML($packageId);

        $headerXML = $header->generateHeader();
        $submitProductPackageXML = $getProductPackageSubmissionResult->generateEnclosingBalise($headerXML . $productPackageFilterXML);
        $bodyXML = $body->generateXML($submitProductPackageXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetOfferPackageSubmissionResult', $envelopeXML);

        $getOfferPackageSubmissionResultResponse = new GetOfferPackageSubmissionResultResponse($response);
        return $getOfferPackageSubmissionResultResponse;
    }

    /**
     * @param $method
     * @param $data
     * @return string
     */
    private function _sendRequest($method, $data)
    {
        $headerRequestURL = ConfigFileLoader::getInstance()->getConfAttribute('methodurl');

        $apiURL = ConfigFileLoader::getInstance()->getConfAttribute('url');

        $request = new CDSApiSoapRequest($method, $headerRequestURL, $apiURL, $data);
        $response = $request->call();

        return $response;
    }
}