<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;


use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\Fulfillment\CreateExternalOrderSoap;
use Sdk\Soap\Fulfillment\GetExternalOrderStatusSoap;
use Sdk\Soap\Fulfillment\Response\CreateExternalOrderResponse;
use Sdk\Soap\Fulfillment\Response\GetExternalOrderStatusResponse;
use Sdk\Soap\Fulfilment\GetFulfilmentOrderListToSupplySoap;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderReportListSoap;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderSoap;
use Sdk\Soap\Fulfilment\GetProductStockListSoap;
use Sdk\Soap\Fulfilment\Response\FulfilmentSupplyOrderReportListResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentOrderListToSupplyResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\GetProductStockListResponse;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentOnDemandSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentSupplyOrderResponse;
use Sdk\Soap\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderSoap;
use Sdk\Soap\Fulfilment\SubmitFulfilmentSupplyOrderSoap;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Fulfilment\SubmitOfferStateActionSoap;
use Sdk\Soap\Fulfilment\Response\SubmitOfferStateActionResponse;
use Sdk\Soap\Fulfilment\SubmitFulfilmentActivationSoap;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentActivationResponse;
use Sdk\Soap\Fulfilment\GetFulfilmentDeliveryDocumentSoap;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentDeliveryDocumentResponse;
use Sdk\Soap\Fulfilment\GetFulfilmentActivationReportListSoap;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentActivationReportRequestXmlResponse;

/*
 * Fulfilment point
 */
class FulfilmentPoint
{
    public function __construct()
    {
    }

    /*
     * @param $offerStateActionRequest \Sdk\Fulfilment\OfferStateActionRequest
     * @return $submitOfferStateActionResponse
     */
    public function SubmitOfferStateAction($offerStateActionRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace('xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitOfferStateAction = new SubmitOfferStateActionSoap();

        $headerXml = $header->generateHeader();
        $offerStateActionRequestXml = $submitOfferStateAction->generateofferStateActionRequestXml($offerStateActionRequest);

        $submitOfferStateActionXml = $submitOfferStateAction->generateEnclosingBalise($headerXml . $offerStateActionRequestXml);

        $bodyXml = $body->generateXML($submitOfferStateActionXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitOfferStateAction', $envelopeXml);

        $submitOfferStateActionResponse = new SubmitOfferStateActionResponse($response);

        return $submitOfferStateActionResponse;
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

    /*
    * @param $fulfilmentOnDemandOrderLineRequest \Sdk\Fulfilment\FulfilmentOnDemandOrderLineFilter
    * @return $getFulfilmentOrderListToSupplyResponse \Sdk\Soap\Fulfilment\Response\GetFulfilmentOrderListToSupplyResponse
    */
    public function GetFulfilmentOrderListToSupply($fulfilmentOnDemandOrderLineRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();

        $getFulfilmentOrderListToSupply = new GetFulfilmentOrderListToSupplySoap();

        $headerXml = $header->generateHeader();
        $fulfilmentOnDemandOrderLineRequestXml = $getFulfilmentOrderListToSupply->generateFulfilmentOnDemandOrderLineRequestXml($fulfilmentOnDemandOrderLineRequest);
        $getFulfilmentOrderListToSupplyXml = $getFulfilmentOrderListToSupply->generateEnclosingBalise($headerXml . $fulfilmentOnDemandOrderLineRequestXml);

        $bodyXml = $body->generateXML($getFulfilmentOrderListToSupplyXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentOrderListToSupply', $envelopeXml);

        $getFulfilmentOrderListToSupplyResponse = new GetFulfilmentOrderListToSupplyResponse($response);
        return $getFulfilmentOrderListToSupplyResponse;
    }

    /*
    * @param $supplyOrderRequest \Sdk\Fulfilment\SupplyOrderRequest
    * @return $getFulfilmentSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\GetFulfilmentSupplyOrderResponse
    */
    public function GetFulfilmentSupplyOrder($supplyOrderRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $envelope->addNameSpace(' xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"');
        $header = new HeaderMessage();
        $body = new Body();
        $getFulfilmentSupplyOrder = new GetFulfilmentSupplyOrderSoap();

        $headerXml = $header->generateHeader();
        $getFulfilmentSupplyOrderRequestXml = $getFulfilmentSupplyOrder->generateGetFulfilmentSupplyOrderRequestXml($supplyOrderRequest);

        $getFulfilmentSupplyOrderXml = $getFulfilmentSupplyOrder->generateEnclosingBalise($headerXml . $getFulfilmentSupplyOrderRequestXml);
        $bodyXml = $body->generateXML($getFulfilmentSupplyOrderXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentSupplyOrder', $envelopeXml);

        $getFulfilmentSupplyOrderResponse = new GetFulfilmentSupplyOrderResponse($response);
        return $getFulfilmentSupplyOrderResponse;
    }

    /*
     * @param $supplyOrderReportRequest \Sdk\Fulfilment\SupplyOrderReportRequest
     * @return $fulfilmentSupplyOrderReportListResponse \Sdk\Soap\Fulfilment\Response\FulfilmentSupplyOrderReportListResponse
     */
    public function GetFulfilmentSupplyOrderReportList($supplyOrderReportRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $envelope->addNameSpace(' xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"');
        $header = new HeaderMessage();
        $body = new Body();
        $fulfilmentSupplyReportList = new GetFulfilmentSupplyOrderReportListSoap();

        $headerXml = $header->generateHeader();
        $supplyOrderReportRequestXml = $fulfilmentSupplyReportList->generateSupplyOrderReportRequestXml($supplyOrderReportRequest);

        $fulfilmentSupplyReportListXml = $fulfilmentSupplyReportList->generateEnclosingBalise($headerXml . $supplyOrderReportRequestXml);

        $bodyXml = $body->generateXML($fulfilmentSupplyReportListXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentSupplyOrderReportList', $envelopeXml);

        $fulfilmentSupplyOrderReportListResponse = new FulfilmentSupplyOrderReportListResponse($response);

        return $fulfilmentSupplyOrderReportListResponse;
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
     * @param $fulfilmentSupplyOrderRequest \Sdk\Fulfilment\FulfilmentSupplyOrderRequest
     * @return $submitFulfilmentSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\SubmitFulfilmentSupplyOrderResponse
     */
    public function SubmitFulfilmentSupplyOrder($fulfilmentSupplyOrderRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace('xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitFulfilmentSupplyOrder = new SubmitFulfilmentSupplyOrderSoap();

        $headerXml = $header->generateHeader();
        $fulfilmentSupplyOrderRequestXml = $submitFulfilmentSupplyOrder->generateFulfilmentSupplyOrderRequestXml($fulfilmentSupplyOrderRequest);

        $submitFulfilmentSupplyOrderXml = $submitFulfilmentSupplyOrder->generateEnclosingBalise($headerXml . $fulfilmentSupplyOrderRequestXml);

        $bodyXml = $body->generateXML($submitFulfilmentSupplyOrderXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitFulfilmentSupplyOrder', $envelopeXml);

        $submitFulfilmentSupplyOrderResponse = new SubmitFulfilmentSupplyOrderResponse($response);

        return $submitFulfilmentSupplyOrderResponse;
    }

    /*
     * @param $fulfilmentOnDemandSupplyOrderRequest \Sdk\Fulfilment\FulfilmentOnDemandSupplyOrderRequest
     * @return $submitFulfilmentOnDemandSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\SubmitFulfilmentOnDemandSupplyOrderResponse
     */
    public function SubmitFulfilmentOnDemandSupplyOrder($fulfilmentOnDemandSupplyOrderRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitFulfilmentOnDemandSupplyOrder = new SubmitFulfilmentOnDemandSupplyOrderSoap();

        $headerXml = $header->generateHeader();
        $fulfilmentOnDemandSupplyOrderRequestXml = $submitFulfilmentOnDemandSupplyOrder->generateFulfilmentOnDemandSupplyOrderRequestXml($fulfilmentOnDemandSupplyOrderRequest);
        $submitFulfilmentOnDemandSupplyOrderXml = $submitFulfilmentOnDemandSupplyOrder->generateEnclosingBalise($headerXml . $fulfilmentOnDemandSupplyOrderRequestXml);

        $bodyXml = $body->generateXML($submitFulfilmentOnDemandSupplyOrderXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitFulfilmentOnDemandSupplyOrder', $envelopeXml);

        $submitFulfilmentOnDemandSupplyOrderResponse = new SubmitFulfilmentOnDemandSupplyOrderResponse($response);
        return $submitFulfilmentOnDemandSupplyOrderResponse;
    }

    /*
     * @param $request \Sdk\Fulfilment\SubmitFulfilmentActivationRequest
     * @return $submitFulfilmentActivationResponse
     */
    public function SubmitFulfilmentActivation($request)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $envelope->addNameSpace(' xmlns:cdis1="http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages"');
        $envelope->addNameSpace(' xmlns:cdis2="http://schemas.datacontract.org/2004/07/Cdiscount.Service.Marketplace.API.External.Contract.Data.Fulfilment"');
        $header = new HeaderMessage();
        $body = new Body();
        $submitFulfilmentActivationSoap = new SubmitFulfilmentActivationSoap();

        $headerXml = $header->generateHeader();
        $submitFulfilmentActivationquestXml = $submitFulfilmentActivationSoap->generateFulfilmentActivationRequestXml($request);

        $getFulfilmentActivationXml = $submitFulfilmentActivationSoap->generateEnclosingBalise($headerXml . $submitFulfilmentActivationquestXml);
        $bodyXml = $body->generateXML($getFulfilmentActivationXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('SubmitFulfilmentActivation', $envelopeXml);

        $submitFulfilmentActivationResponse = new SubmitFulfilmentActivationResponse($response);
        return $submitFulfilmentActivationResponse;
    }

    /*
     * @param $fulfilmentDeliveryRequest \Sdk\Fulfilment\FulfilmentDeliveryRequest
     * @return $getFulfilmentDeliveryDocumentResponse
     */
    public function GetFulfilmentDeliveryDocument($fulfilmentDeliveryRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $getFulfilmentDeliveryDocument = new GetFulfilmentDeliveryDocumentSoap();

        $headerXml = $header->generateHeader();
        $getFulfilmentDeliveryDocumentRequestXml = $getFulfilmentDeliveryDocument->generateFulfilmentDeliveryDocumentRequestXml($fulfilmentDeliveryRequest);

        $getFulfilmentDeliveryDocumentXml = $getFulfilmentDeliveryDocument->generateEnclosingBalise($headerXml . $getFulfilmentDeliveryDocumentRequestXml);

        $bodyXml = $body->generateXML($getFulfilmentDeliveryDocumentXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentDeliveryDocument', $envelopeXml);

        $getFulfilmentDeliveryDocumentResponse = new GetFulfilmentDeliveryDocumentResponse($response);

        return $getFulfilmentDeliveryDocumentResponse;
    }

    /*
     * @param $FulfilmentActivationReportRequest \Sdk\Fulfilment\FulfilmentActivationReportRequest
     * @return $FulfilmentActivationReportRequestXmlResponse
     */
    public function GetFulfilmentActivationReportList($FulfilmentActivationReportRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $FulfilmentActivationReportList = new GetFulfilmentActivationReportListSoap();

        $headerXml = $header->generateHeader();

        $FulfilmentActivationReportRequestXml = $FulfilmentActivationReportList->generateFulfilmentActivationReportRequestXml($FulfilmentActivationReportRequest);

        $FulfilmentActivationReportXml = $FulfilmentActivationReportList->generateEnclosingBalise($headerXml . $FulfilmentActivationReportRequestXml);

        $bodyXml = $body->generateXML($FulfilmentActivationReportXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        $response = $this->_sendRequest('GetFulfilmentActivationReportList', $envelopeXml);

        $FulfilmentActivationReportRequestXmlResponse = new GetFulfilmentActivationReportRequestXmlResponse($response);

        return $FulfilmentActivationReportRequestXmlResponse;
    }

    /*
     * @param $method
     * @param $data
     * @return $response
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