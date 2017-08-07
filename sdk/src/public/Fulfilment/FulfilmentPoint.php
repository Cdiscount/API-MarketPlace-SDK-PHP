<?php
/*
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

use Sdk\Soap\Fulfilment\SubmitFulfilmentSupplyOrderSoap;
use Sdk\Soap\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderSoap;
use Sdk\Soap\Fulfilment\GetFulfilmentOrderListToSupplySoap;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\SubmitFulfilmentOnDemandSupplyOrderResponse;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentOrderListToSupplyResponse;
use Sdk\Fulfilment\SupplyOrderRequest;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderSoap;
use Sdk\Soap\Fulfilment\Response\GetFulfilmentSupplyOrderResponse;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderReportListSoap;
use Sdk\Soap\Fulfilment\Response\FulfilmentSupplyOrderReportListResponse;
use Sdk\Soap\Fulfilment\SubmitOfferStateActionSoap;
use Sdk\Soap\Fulfilment\Response\SubmitOfferStateActionResponse;

/*
 * Fulfilment point
 */
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
        //echo ' Request : '.nl2br(htmlentities($envelopeXml , ENT_QUOTES | ENT_IGNORE, "UTF-8"));
        
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

        //echo ' Request SOAP : '.nl2br(htmlentities($envelopeXml , ENT_QUOTES | ENT_IGNORE, "UTF-8"));

        $response = $this->_sendRequest('GetFulfilmentSupplyOrderReportList', $envelopeXml);

        $fulfilmentSupplyOrderReportListResponse = new FulfilmentSupplyOrderReportListResponse($response);
       
        return $fulfilmentSupplyOrderReportListResponse;
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
        //echo '<br/><br/><p> Response string : <br/><br/>'.nl2br(htmlentities($envelopeXml , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        $response = $this->_sendRequest('GetFulfilmentOrderListToSupply', $envelopeXml);

        //echo '<br/><br/><p> Response string : <br/><br/>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getFulfilmentOrderListToSupplyResponse = new GetFulfilmentOrderListToSupplyResponse($response);
        return $getFulfilmentOrderListToSupplyResponse;
    }

    /*
     * @param $supplyOrderRequest \Sdk\Fulfilment\SupplyOrderRequest
     * @return $getFulfilmentSupplyOrderResponse \Sdk\Soap\Fulfilment\Response\GetFulfilmentSupplyOrderResponse
     */
    public function GetFulfilementSupplyOrder($supplyOrderRequest)
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
        //echo '<br/><br/><p> Requete string : <br/><br/>'.nl2br(htmlentities($envelopeXml , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        $response = $this->_sendRequest('GetFulfilmentSupplyOrder', $envelopeXml);
        //echo '<br/><br/><p> Response string : <br/><br/>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getFulfilmentSupplyOrderResponse = new GetFulfilmentSupplyOrderResponse($response);
        return $getFulfilmentSupplyOrderResponse;
    }

}