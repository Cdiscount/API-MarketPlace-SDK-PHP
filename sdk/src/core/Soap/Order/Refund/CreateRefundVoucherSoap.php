<?php

/*
 * Created by CDiscount
 * Date: 31/01/2017
 * Time: 15:13
 */

namespace Sdk\Soap\Order\Refund;
use Sdk\Soap\BaliseTool;
/**
 * class contains creation tags
 * @author mohammed.sajid
 */
class CreateRefundVoucherSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_requestTAG = 'request';
    
    /*
     * @var string
     */
    private $_commercialGestureListTAG = 'CommercialGestureList';
    
    /*
     * @var string
     */
    private $_orderNumberTAG = 'OrderNumber';
    
    /*
     * @var string
     */
    private $_sellerRefundListTAG = 'SellerRefundList';


    /*
     * CreateRefundVoucherSoap constructor
     * @param $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'CreateRefundVoucher';
        parent::__construct();
    }
    
    /*
     * @param $createRefundVoucherRequest \Sdk\Order\Refund\CreateRefundVoucherRequest
     */
     public function generateCreateRefundVoucherRequestRequestXml($createRefundVoucherRequest)
     {
         $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        
        /*
         * request
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_requestTAG);
        
        /*
         * CommercialGestureList
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_commercialGestureListTAG);
        
        /*
         * @param $refundInformation \Sdk\Order\Refund\RefundInformation
         */
        foreach ($createRefundVoucherRequest->getCommercialGestureList() as $refundInformation) {
            /*
             * RefundInformation
             */
            $refundInformationSoap = new RefundInformationSoap($refundInformation);
            $xml .= $refundInformationSoap->serialize();
        }
        
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_commercialGestureListTAG);
        
        /**
         * OrderNumber
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_orderNumberTAG, $createRefundVoucherRequest->getOrderNumber());


        /**
         * SellerRefundRequestList
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_sellerRefundListTAG);

        /** @var \Sdk\Order\Refund\SellerRefundRequest $sellerRefundRequest */
        foreach ($createRefundVoucherRequest->getSellerRefundList() as $sellerRefundRequest) {

            /**
             * SellerRefundRequest
             */
            $sellerRefundRequestSoap = new SellerRefundRequestSoap($sellerRefundRequest);
            $xml .= $sellerRefundRequestSoap->serialize();
        }

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_sellerRefundListTAG);
        
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_requestTAG);

        $this->_xmlUtil->setGlobalPrefix('');

        return $xml;
     }
}
