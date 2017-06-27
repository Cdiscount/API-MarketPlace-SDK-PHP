<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:11
 */

namespace Sdk\Soap\Fulfillment;

use Sdk\Soap\BaliseTool;

/**
 * Get External Order Status
 */
class GetExternalOrderStatusSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_requestTag = 'cdis:request';

    /*
     * @var string
     */
    private $_corporationTag = 'cdis2:Corporation';

    /*
     * @var string
     */
    private $_customerOrderNumberTag = 'cdis2:CustomerOrderNumber';

   /*
    * Name Space
    */
    private $_xmlns_cdis2  ='xmlns:cdis2="http://schemas.datacontract.org/2004/07/Cdiscount.Service.Marketplace.API.External.Contract.Data.Order"';

    /**
     * GetExternalOrderStatusSoap constructor.
     * @param $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetExternalOrderStatus';
        parent::__construct();
    }

    /*
     * @param $request \Sdk\Fulfilment\OrderStatusRequest
     */
    public function generateOrderStatusRequestXml($request)
    {
        $inlines = array($this->_xmlns_cdis2);

        /*
         * Opening Tag Request
         */
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_requestTag, $inlines);

        /*
         * Tag corporation
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_corporationTag, $request->getCorporation());

        /*
         * Tag customerOrderNumber
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_customerOrderNumberTag, $request->getCustomerOrderNumber());

        //Closed tag Request
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_requestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');
        
        return $xml;

    }
}