<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 09:21
 */

namespace Sdk\Discussion;

use Sdk\AbstractPoint;
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

class DiscussionPoint extends AbstractPoint
{

    /**
     * @param $claimFilter
     * @return GetOrderClaimListResponse
     */
    public function getOrderClaimList($claimFilter)
    {
        //$optionalsNamespaces = array('xmlns:cdis="http://www.cdiscount.com"', 'xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"');
        $optionalsNamespaces = array(
        		'xmlns:cdis="http://www.cdiscount.com"', 
        		'xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"',
        		'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"',
        );
        
        $getOrderClaimList = new GetOrderClaimList();
        $claimFilterSoap = new ClaimFilterSoap($optionalsNamespaces);

        $envelopeXML = $this->_buildGenericListXML($getOrderClaimList, $claimFilterSoap, $claimFilter, $optionalsNamespaces);

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

        $response = $this->_sendRequest('GetOrderQuestionList', $envelopeXML);

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

        $response = $this->_sendRequest('GetOfferQuestionList', $envelopeXML);

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

        $response = $this->_sendRequest('CloseDiscussionList', $envelopeXML);

        $closeDiscussionListResponse = new CloseDiscussionListResponse($response);
        return $closeDiscussionListResponse;
    }

    /**
     * @param $questionList
     * @param $filterSoap
     * @param $filter
     * @param $namespaces array string : optionals namespaces
     * @return string
     */
    private function _buildGenericListXML($questionList, $filterSoap, $filter, $namespaces = null)
    {
        /**
         * Enveloppe
         */
        $envelope = new Envelope();

        /**
         * Adding optional namepaces
         */
        if (isset($namespaces)) {
            foreach ($namespaces as $namespace) {
                $envelope->addNameSpace($namespace);
            }
        }

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
}
