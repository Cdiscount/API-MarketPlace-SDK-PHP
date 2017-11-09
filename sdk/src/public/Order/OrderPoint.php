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
use Sdk\Soap\Order\GetOrderList;
use Sdk\Soap\Order\GetOrderListResponse;
use Sdk\Soap\Order\ManageParcelSoap;
use Sdk\Soap\Order\OrderFilterSoap;
use Sdk\Soap\Order\OrderListSoap;
use Sdk\Soap\Order\Refund\CreateRefundVoucherAfterShipment;
use Sdk\Soap\Order\Refund\CreateRefundVoucherSoap;
use Sdk\Soap\Order\Refund\RequestSoap;
use Sdk\Soap\Order\Refund\Response\CreateRefundVoucherResponse;
use Sdk\Soap\Order\Response\ManageParcelResponse;
use Sdk\Soap\Order\ValidateOrderList;
use Sdk\Soap\Order\ValidateOrderListResponse;

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

        $response = $this->_sendRequest('ValidateOrderList', $envelopeXML);

        //$response = "<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\"><s:Body><ValidateOrderListResponse xmlns=\"http://www.cdiscount.com\"><ValidateOrderListResult xmlns:i=\"http://www.w3.org/2001/XMLSchema-instance\"><ErrorMessage i:nil=\"true\" xmlns=\"http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages\"/><OperationSuccess xmlns=\"http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages\">true</OperationSuccess><ErrorList/><SellerLogin>login</SellerLogin><TokenId>???</TokenId><ValidateOrderResults><ValidateOrderResult><Errors/><OrderNumber>1109029051W54OU</OrderNumber><ValidateOrderLineResults><ValidateOrderLineResult><Errors/><SellerProductId>CHI8003970895435</SellerProductId><Updated>true</Updated></ValidateOrderLineResult><ValidateOrderLineResult><Errors/><SellerProductId>DOD3592668078117</SellerProductId><Updated>true</Updated></ValidateOrderLineResult><ValidateOrderLineResult><Errors/><SellerProductId>FRAISTRAITEMENT</SellerProductId><Updated>true</Updated></ValidateOrderLineResult></ValidateOrderLineResults><Validated>true</Validated><Warnings/></ValidateOrderResult></ValidateOrderResults></ValidateOrderListResult></ValidateOrderListResponse></s:Body></s:Envelope>";

        $validateOrderListResponse = new ValidateOrderListResponse($response);
        return $validateOrderListResponse;
    }

    /**
     * @param $orderFilter OrderFilter
     * @return GetOrderListResponse
     */
    public function getOrderList($orderFilter)
    {
        $optionalsNamespaces = array('xmlns:cdis="http://www.cdiscount.com"', 'xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"');

        $envelope = new Envelope();

        foreach ($optionalsNamespaces as $namespace) {
            $envelope->addNameSpace($namespace);
        }

        $body = new Body();
        $getOrderList = new GetOrderList();
        $header = new HeaderMessage();

        $orderFilterSoap = new OrderFilterSoap($optionalsNamespaces);
        $orderFilterSoap->serializeChild($orderFilter);

        $headerXML = $header->generateHeader();
        $orderfilterXML = $orderFilterSoap->generateEnclosingBaliseWithChildren();
        $orderListXML = $getOrderList->generateEnclosingBalise($headerXML . $orderfilterXML);
        $bodyXML = $body->generateXML($orderListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetOrderList', $envelopeXML);

        $sellerInfoResponse = new GetOrderListResponse($response);
        return $sellerInfoResponse;
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



        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        $response = $this->_sendRequest('CreateRefundVoucherAfterShipment', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
    }

    /*
     * @param $manageParcelrequest \Sdk\Order\ManageParcelRequest
     * @return $manageParcelResponse
     */
    public function ManageParcel($manageParcelRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        $manageParcel = new ManageParcelSoap();

        $headerXml = $header->generateHeader();
        $manageParcelRequestXml = $manageParcel->generateManageParcelRequestXml($manageParcelRequest);

        $manageParcelXml = $manageParcel->generateEnclosingBalise($headerXml . $manageParcelRequestXml);

        $bodyXml = $body->generateXML($manageParcelXml);

        $envelopeXml = $envelope->generateXML($bodyXml);

        //echo '<p> Request : <br/><br/>'.nl2br(htmlentities($envelopeXml , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        $response = $this->_sendRequest('ManageParcel', $envelopeXml);
        //echo '<br/><br/><p> Response string : <br/><br/>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $manageParcelResponse = new ManageParcelResponse($response);
        //echo '<br/><br/>Response PHP object : <br/>';
        //print_r($manageParcelResponse);
        return $manageParcelResponse;
    }
    
    /*
     * @param $createRefundVoucherRequest \Sdk\Order\Refund\CreateRefundVoucherRequest
     * @return $createRefundVoucherResponse
     */
    public function CreateRefundVoucher($createRefundVoucherRequest)
    {
        $envelope = new Envelope();
        $envelope->addNameSpace(' xmlns:cdis="http://www.cdiscount.com"');
        $header = new HeaderMessage();
        $body = new Body();
        
        $createRefundVoucher = new CreateRefundVoucherSoap();
        
        $headerXML = $header->generateHeader();
        $requestXML = $createRefundVoucher->generateCreateRefundVoucherRequestRequestXml($createRefundVoucherRequest);
        
        $createRefundVoucherXML = $createRefundVoucher->generateEnclosingBalise($headerXML . $requestXML);
        
        $bodyXML = $body->generateXML($createRefundVoucherXML);
        
        $envelopeXML = $envelope->generateXML($bodyXML);
        //echo '<p> Request : <br/><br/>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        $response = $this->_sendRequest('CreateRefundVoucher', $envelopeXML);
        //echo '<p> Response : <br/><br/>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';
        
        $createRefundVoucherResponse = new CreateRefundVoucherResponse($response);
        
        return $createRefundVoucherResponse;
    }

    private function _sendRequest($method, $data)
    {
        $headerRequestURL = ConfigFileLoader::getInstance()->getConfAttribute('methodurl');

        $apiURL = ConfigFileLoader::getInstance()->getConfAttribute('url');

        $request = new CDSApiSoapRequest($method, $headerRequestURL, $apiURL, $data);
        $response = $request->call();

        return $response;
    }

}