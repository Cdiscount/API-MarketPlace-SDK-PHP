<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 09:21
 */

namespace Sdk\Discussion;


use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;
use Sdk\Soap\Common\Body;
use Sdk\Soap\Common\Envelope;
use Sdk\Soap\Discussion\ClaimFilterSoap;
use Sdk\Soap\Discussion\CloseDiscussionList;
use Sdk\Soap\Discussion\GetOfferQuestionList;
use Sdk\Soap\Discussion\GetOrderClaimList;
use Sdk\Soap\Discussion\GetOrderQuestionList;
use Sdk\Soap\Discussion\OfferQuestionFilterSoap;
use Sdk\Soap\Discussion\OrderQuestionFilterSoap;
use Sdk\Soap\Discussion\Response\CloseDiscussionListResponse;
use Sdk\Soap\Discussion\Response\GetOfferQuestionListResponse;
use Sdk\Soap\Discussion\Response\GetOrderClaimListResponse;
use Sdk\Soap\Discussion\Response\GetOrderQuestionListResponse;
use Sdk\Soap\HeaderMessage\HeaderMessage;

class DiscussionPoint
{

    /**
     * @param $claimFilter
     * @return GetOrderClaimListResponse
     */
    public function getOrderClaimList($claimFilter)
    {
        $getOrderClaimList = new GetOrderClaimList();
        $claimFilterSoap = new ClaimFilterSoap();

        $envelopeXML = $this->_buildGenericListXML($getOrderClaimList, $claimFilterSoap, $claimFilter);

        $response = $this->_sendRequest('GetOrderClaimList', $envelopeXML);

        $getOrderClaimListResponse = new GetOrderClaimListResponse($response);
        return $getOrderClaimListResponse;
    }

    /**
     * @param $orderQuestionFilter OrderQuestionFilter
     * @return GetOrderQuestionListResponse
     */
    public function getOrderQuestionList($orderQuestionFilter)
    {
        $getOrderQuestionList = new GetOrderQuestionList();

        $orderQuestionFilterSoap = new OrderQuestionFilterSoap();

        $envelopeXML = $this->_buildGenericListXML($getOrderQuestionList, $orderQuestionFilterSoap, $orderQuestionFilter);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetOrderQuestionList', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getOrderQuestionListResponse = new GetOrderQuestionListResponse($response);
        return $getOrderQuestionListResponse;
    }

    /**
     * @param $orderQuestionFilter
     * @return GetOfferQuestionListResponse
     */
    public function getOfferQuestionList($orderQuestionFilter)
    {
        $getOfferQuestionList = new GetOfferQuestionList();

        $offerQuestionFilterSoap = new OfferQuestionFilterSoap();

        $envelopeXML = $this->_buildGenericListXML($getOfferQuestionList, $offerQuestionFilterSoap, $orderQuestionFilter);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('GetOfferQuestionList', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $getOfferQuestionListResponse = new GetOfferQuestionListResponse($response);
        return $getOfferQuestionListResponse;
    }

    /**
     * @param $discussionIds array
     * @return CloseDiscussionListResponse
     */
    public function closeDiscussionList($discussionIds)
    {
        $envelope = new Envelope();
        $body = new Body();
        $closeDiscussionList = new CloseDiscussionList();
        $header = new HeaderMessage();

        $closeDiscussionRequestXML = $closeDiscussionList->generateCloseDiscussionRequestXML($discussionIds);

        $headerXML = $header->generateHeader();
        $closeDiscussionListXML = $closeDiscussionList->generateEnclosingBalise($headerXML . $closeDiscussionRequestXML);
        $bodyXML = $body->generateXML($closeDiscussionListXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        //echo '<p>'.nl2br(htmlentities($envelopeXML , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $response = $this->_sendRequest('CloseDiscussionList', $envelopeXML);

        //echo '<p>'.nl2br(htmlentities($response , ENT_QUOTES | ENT_IGNORE, "UTF-8")).'</p>';

        $closeDiscussionListResponse = new CloseDiscussionListResponse($response);
        return $closeDiscussionListResponse;
    }

    /**
     * @param $questionList
     * @param $filterSoap
     * @param $filter
     * @return string
     */
    private function _buildGenericListXML($questionList, $filterSoap, $filter)
    {
        $envelope = new Envelope();
        $body = new Body();

        $header = new HeaderMessage();

        $filterSoap->serializeChild($filter);

        $headerXML = $header->generateHeader();
        $orderfilterXML = $filterSoap->generateEnclosingBaliseWithChildren();

        $orderClaimXML = $questionList->generateEnclosingBalise($headerXML . $orderfilterXML);

        $bodyXML = $body->generateXML($orderClaimXML);
        $envelopeXML = $envelope->generateXML($bodyXML);

        return $envelopeXML;
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