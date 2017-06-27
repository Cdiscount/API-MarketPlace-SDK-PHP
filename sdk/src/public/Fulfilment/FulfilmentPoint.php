<?php
/**
 * Created by CDiscount
 * Date: 26/04/2017
 * Time: 11:47
 */

namespace Sdk\Fulfilment;

use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Fulfilment\Response\GetProductStockListResponse;
use Sdk\Soap\Fulfilment\GetProductStockListSoap;
use Sdk\Soap\Fulfilment\GetProductStockList;
use Sdk\Soap\Fulfillment\GetExternalOrderStatusSoap;
use Sdk\Soap\Fulfillment\Response\GetExternalOrderStatusResponse;
use Sdk\Soap\Fulfillment\CreateExternalOrderSoap;
use Sdk\Soap\Fulfillment\Response\CreateExternalOrderResponse;

class FulfilmentPoint
{
    public function __construct()
    {
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
        return $response;
    }

    /*
     * @param $fulfillmentProductRequest \Sdk\Fulfilment\FulfillmentProductRequest
     * @return $getProductStockListResponse
     */
    public function GetProductStockList($fulfilmentProductRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $getProductStockList = new GetProductStockListSoap();
        $headerXml = $header->generateHeader();
        $fulfilmentProductRequestXml = $getProductStockList->generateFulfilmentProductRequestXml($fulfilmentProductRequest);
        $getProductStockListXml = $getProductStockList->generateEnclosingBalise($headerXml . $fulfilmentProductRequestXml);
        $bodyXml = $body->generateXML($getProductStockListXml);
        $envelopeXml = $envelope->generateXML($bodyXml);
        $response = $this->_sendRequest('GetProductStockList', $envelopeXml);
        $getProductStockListResponse = new GetProductStockListResponse($response);
        return $getProductStockListResponse;
    }

    /*
     * @param $orderStatusRequest \Sdk\Fulfilment\OrderStatusRequest
     * @return $getExternalOrderStatusResponse
     */
    public function GetExternalOrderStatus($orderStatusRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $getExternalOrderStatus = new GetExternalOrderStatusSoap();
        $headerXml = $header->generateHeader();
        $orderStatusRequestXml = $getExternalOrderStatus->generateOrderStatusRequestXml($orderStatusRequest);
        $getExternalOrderStatusXml = $getExternalOrderStatus->generateEnclosingBalise($headerXml . $orderStatusRequestXml);
        $bodyXml = $body->generateXML($getExternalOrderStatusXml);
        $envelopeXml = $envelope->generateXML($bodyXml);
        $response = $this->_sendRequest('GetExternalOrderStatus', $envelopeXml);
        $getExternalOrderStatusResponse = new GetExternalOrderStatusResponse($response);
        return $getExternalOrderStatusResponse;
    }

     /*
     * @param $orderIntegrationRequest \Sdk\Fulfilment\orderIntegrationRequest
     * @return $createExternalOrderResponse
     */
    public function CreateExternalOrder($orderIntegrationRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $createExternalOrderSoap = new CreateExternalOrderSoap();
        $headerXml = $header->generateHeader();
        $orderIntegrationRequestXml = $createExternalOrderSoap->generateFulfillmentProductRequestXml($orderIntegrationRequest);
        $createExternalOrderXml = $createExternalOrderSoap->generateEnclosingBalise($headerXml . $orderIntegrationRequestXml);
        $bodyXml = $body->generateXML($createExternalOrderXml);
        $envelopeXml = $envelope->generateXML($bodyXml);
        $response = $this->_sendRequest('CreateExternalOrder', $envelopeXml);
        $createExternalOrderResponse = new CreateExternalOrderResponse($response);
        return $createExternalOrderResponse;
    }
}