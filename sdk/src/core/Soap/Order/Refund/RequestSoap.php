<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 16:33
 */

namespace Sdk\Soap\Order\Refund;


use Sdk\Soap\BaliseTool;

class RequestSoap extends BaliseTool
{

    private $_OrderNumberTAG = 'OrderNumber';
    private $_SellerRefundRequestListTAG = 'SellerRefundRequestList';
    private $_SellerRefundRequestTAG = 'SellerRefundRequest';

    /**
     * @var null|\Sdk\Order\Refund\Request
     */
    private $_request = null;

    /**
     * RequestSoap constructor.
     * @param $request \Sdk\Order\Refund\Request
     */
    public function __construct($request)
    {
        $this->_request = $request;
        $this->_tag = 'request';
        parent::__construct();
    }

    /**
     * @return string
     */
    public function generateXML()
    {
        $xml = $this->_generateOpenBalise();

        /**
         * OrderNumber
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_OrderNumberTAG, $this->_request->getOrderNumber());


        /**
         * SellerRefundRequestList
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_SellerRefundRequestListTAG);

        /** @var \Sdk\Order\Refund\SellerRefundRequest $sellerRefundRequest */
        foreach ($this->_request->getSellerRefundRequestList() as $sellerRefundRequest) {

            /**
             * SellerRefundRequest
             */
            $sellerRefundRequestSoap = new SellerRefundRequestSoap($sellerRefundRequest);
            $xml .= $sellerRefundRequestSoap->serialize();
        }

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_SellerRefundRequestListTAG);

        $xml .= $this->_generateCloseBalise();

        return $xml;
    }
}