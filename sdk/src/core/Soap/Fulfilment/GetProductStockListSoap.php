<?php

/* 
 * Created by Cdiscount
 * Date : 26/04/2017
 * Time : 12:14
 */
namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class GetProductStockListSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_fulfilmentProductRequestTag = 'cdis:request';

    /*
     * @var string
     */
    private $_barCodeListTag = 'cdis3:BarCodeList';

    /*
    * Name Space
    */
    private $_xmlns_array  = 'xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"';
    private $_xmlns_cdis3  ='xmlns:cdis3="http://schemas.datacontract.org/2004/07/Cdiscount.Service.Marketplace.API.External.Contract.Data.Product"';

    /*
     * @var string
     */
    private $_stringTag = 'arr:string';

    /**
     * GetProductStockList constructor.
     * @param $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetProductStockList';
        parent::__construct();
    }

    /*
     * @param $request \Sdk\src\public\Fulfilment\FulfilmentProductRequest
     */
    public function generateFulfilmentProductRequestXml($request)
    {
        $inlines = array($this->_xmlns_array, $this->_xmlns_cdis3);

        /*
         * Opening Tag fulfilmentProductRequest
         */
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_fulfilmentProductRequestTag, $inlines);

        /*
         * Opening Tag barCodeList
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_barCodeListTag);

        // Loop into string barCodeList
        foreach($request->getBarCodeList() as $ean)
        {
            //Tag string barCode
            $xml .= $this->_xmlUtil->generateBalise($this->_stringTag, $ean);
        }

        //Closed Tag BarCodeList
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_barCodeListTag);

        //Closed Tag FulfillmentProductRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentProductRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');
    
        return $xml;
    }
}
