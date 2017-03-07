<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 10:49
 */

namespace Sdk\Relays;


use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\HeaderMessage\HeaderMessage;
use Sdk\Soap\Relays\GetParcelShopList;

class RelaysPoint
{

    /**
     * Get Parcel Shop List
     */
    public function getParcelShopList()
    {
        $envelope = new Envelope();
        $body = new Body();
        $getParcelShopList = new GetParcelShopList();
        $header = new HeaderMessage();

        $headerXML = $header->generateHeader();
        $submitProductPackageXML = $getParcelShopList->generateEnclosingBalise($headerXML);
        $bodyXML = $body->generateXML($submitProductPackageXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetParcelShopList', $envelopeXML);

        echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        //$getProductPackageSubmissionResultResponse = new GetProductPackageSubmissionResultResponse($response);
        //return $getProductPackageSubmissionResultResponse;
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
}