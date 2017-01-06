<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 15:30
 */

namespace Sdk\Order;


use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Order\GetGlobalConfiguration;
use Sdk\Soap\Order\GetOrderList;
use Sdk\Soap\Order\GetOrderListResponse;
use Sdk\Soap\Order\ManageParcelSoap;
use Sdk\Soap\Order\OrderFilterSoap;
use Sdk\Soap\Order\OrderListSoap;
use Sdk\Soap\Order\Refund\CreateRefundVoucherAfterShipment;
use Sdk\Soap\Order\Refund\RequestSoap;
use Sdk\Soap\Order\Response\GetGlobalConfigurationResponse;
use Sdk\Soap\Order\Response\ManageParcelResponse;
use Sdk\Soap\Order\ValidateOrderList;
use Sdk\Soap\Order\ValidateOrderListResponse;
use Sdk\Soap\Order\ValidateOrderSoap;

class OrderPoint
{

    public function __construct()
    {
    }

    /**
     * @param $order \Sdk\Order\OrderList
     * @return ValidateOrderListResponse
     */
    public function validateOrderList($order)
    {
        $envelope = new Envelope();
        $body = new Body();
        $validateOrderList = new ValidateOrderList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();

        $orderListSoap = new OrderListSoap($order);
        $orderListXML = $orderListSoap->serialize();
        $validateOrderListXML = $validateOrderList->generateEnclosingBalise($headerXML . $orderListXML);

        $bodyXML = $body->generateXML($validateOrderListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('ValidateOrderList', $envelopeXML);

        $response = "<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\"><s:Body><ValidateOrderListResponse xmlns=\"http://www.cdiscount.com\"><ValidateOrderListResult xmlns:i=\"http://www.w3.org/2001/XMLSchema-instance\"><ErrorMessage i:nil=\"true\" xmlns=\"http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages\"/><OperationSuccess xmlns=\"http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages\">true</OperationSuccess><ErrorList/><SellerLogin>login</SellerLogin><TokenId>???</TokenId><ValidateOrderResults><ValidateOrderResult><Errors/><OrderNumber>1109029051W54OU</OrderNumber><ValidateOrderLineResults><ValidateOrderLineResult><Errors/><SellerProductId>CHI8003970895435</SellerProductId><Updated>true</Updated></ValidateOrderLineResult><ValidateOrderLineResult><Errors/><SellerProductId>DOD3592668078117</SellerProductId><Updated>true</Updated></ValidateOrderLineResult><ValidateOrderLineResult><Errors/><SellerProductId>FRAISTRAITEMENT</SellerProductId><Updated>true</Updated></ValidateOrderLineResult></ValidateOrderLineResults><Validated>true</Validated><Warnings/></ValidateOrderResult></ValidateOrderResults></ValidateOrderListResult></ValidateOrderListResponse></s:Body></s:Envelope>";

        echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $validateOrderListResponse = new ValidateOrderListResponse($response);
        return $validateOrderListResponse;
    }

    /**
     * @param $orderFilter OrderFilter
     * @return GetOrderListResponse
     */
    public function getOrderList($orderFilter)
    {

        $envelope = new Envelope();
        $body = new Body();
        $getOrderList = new GetOrderList();
        $header = new HeaderMessage();

        $orderFilterSoap = new OrderFilterSoap();
        $orderFilterSoap->serializeChild($orderFilter);

        $headerXML = $header->generateHeader();
        $orderfilterXML = $orderFilterSoap->generateEnclosingBaliseWithChildren();
        $orderListXML = $getOrderList->generateEnclosingBalise($headerXML . $orderfilterXML);
        $bodyXML = $body->generateXML($orderListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetOrderList', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $sellerInfoResponse = new GetOrderListResponse($response);
        return $sellerInfoResponse;
    }

    /**
     * Get Global Configuration
     *
     * @return GetGlobalConfigurationResponse
     */
    public function getGlobalConfiguration()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getOrderList = new GetGlobalConfiguration();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $getGlobalConfigurationXML = $getOrderList->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($getGlobalConfigurationXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetGlobalConfiguration', $envelopeXML);

        $getGlobalConfigurationResponse = new GetGlobalConfigurationResponse($response);
        return $getGlobalConfigurationResponse;
    }

    /**
     * @param $request \Sdk\Order\Refund\Request
     */
    public function CreateRefundVoucherAfterShipment($request)
    {
        $envelope = new Envelope();
        $body = new Body();
        $createRefundVoucherAfterShipment = new CreateRefundVoucherAfterShipment();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();

        $requestSoap = new RequestSoap($request);
        $requestXML = $requestSoap->generateXML();

        $createRefundVoucherAfterShipmentXML = $createRefundVoucherAfterShipment->generateEnclosingBalise($headerXML . $requestXML);

        $bodyXML = $body->generateXML($createRefundVoucherAfterShipmentXML);
        $envelopeXML = $envelope->generateXML($bodyXML);


        $envelopeXML = "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:cdis=\"http://www.cdiscount.com\" xmlns:cdis1=\"http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages\"><soapenv:Body><CreateRefundVoucherAfterShipment>".$headerXML.
        "<request>
            <OrderNumber>1209041030XVM5M</OrderNumber>
            <SellerRefundRequestList>
               <SellerRefundRequest>
                  <Mode>Claim</Mode>
                  <Motive>ClientClaim</Motive>
                  <RefundOrderLine>
                     <Ean>0021165108288</Ean>
                     <SellerProductId>PC1890</SellerProductId>
					 <RefundShippingCharges>true</RefundShippingCharges>
                  </RefundOrderLine>
               </SellerRefundRequest>
            </SellerRefundRequestList>
         </request>
      </CreateRefundVoucherAfterShipment></soapenv:Body></soapenv:Envelope>";



        echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        $response = $this->_sendRequest('CreateRefundVoucherAfterShipment', $envelopeXML);

        echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

    }

    /**
     * @param $request \Sdk\Order\ManageParcelRequest
     * @return ManageParcelResponse
     */
    public function manageParcel($request)
    {
        /**
         * Create Soap Enveloppe
         */
        $envelope = new Envelope();
        $envelope->addNamespace('xmlns:cdis="http://www.cdiscount.com"');
        $body = new Body();
        $header = new HeaderMessage();
        $manageParcel = new ManageParcelSoap();
        $headerXML = $header->generateHeader();
        $manageParcelRequestXML = $manageParcel->generateManageParcelRequestXML($request, 'cdis:');
        $manageParcelXML = $manageParcel->generateEnclosingBalise($headerXML . $manageParcelRequestXML);
        $bodyXML = $body->generateXML($manageParcelXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        /**
         * Send Soap Enveloppe
         */
        $response = $this->_sendRequest('ManageParcel', $envelopeXML);

        /**
         * Parse response and create PHP Objects
         */
        $manageParcelResponse = new ManageParcelResponse($response);

        return $manageParcelResponse;
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