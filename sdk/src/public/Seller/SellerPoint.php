<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 27/09/2016
 * Time: 15:19
 */

namespace Sdk\Seller;

use Sdk\AbstractPoint;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Seller\GetSellerIndicators;
use Sdk\Soap\Seller\GetSellerInformation;
use Sdk\Soap\Seller\GetSellerInformationResponse;
use Sdk\Soap\Seller\Response\GetSellerIndicatorsResponse;

/**
 * Class SellerPoint
 * @package Seller
 */
class SellerPoint extends AbstractPoint
{
    /**
     * @return GetSellerInformationResponse
     */
    public function getSellerInformation()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getSellerInfo = new GetSellerInformation();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $getSellerInfoXML = $getSellerInfo->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($getSellerInfoXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetSellerInformation', $envelopeXML);

        return new GetSellerInformationResponse($response);
    }

    /**
     * @return GetSellerIndicatorsResponse
     */
    public function getSellerIndicators()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getSellerInfo = new GetSellerIndicators();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $getSellerInfoXML = $getSellerInfo->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($getSellerInfoXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        $response = $this->_sendRequest('GetSellerIndicators', $envelopeXML);

        return new GetSellerIndicatorsResponse($response);
    }
}