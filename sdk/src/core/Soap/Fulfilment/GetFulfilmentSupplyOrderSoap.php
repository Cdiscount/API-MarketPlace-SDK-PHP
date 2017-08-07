<?php

/* 
 * Created by Zakaria Boukhris
 * Date : 28/04/2017
 * Time : 15:46
 */
namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class GetFulfilmentSupplyOrderSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_supplyOrderRequestTag = 'cdis:request';

    /*
     *@var string
     */
    private $_supplyOrderNumberListTAG = 'cdis:SupplyOrderNumberList';
    
    /*
     * @var string
     */
    private $_pageSizeTAG = 'cdis:PageSize';

     /*
     * @var string
     */
    private $_pageNumberTAG = 'cdis:PageNumber';

    /*
     * @var string
     */
    private $_beginModificationDateTAG = 'cdis:BeginModificationDate';

     /*
     * @var string
     */
    private $_endModificationDateTAG = 'cdis:EndModificationDate';
    
    /*
     * @var string
     */
    private $_arrStringTAG = 'arr:string';

    /*
     * @var string
     */
    private $_xmlnsa = 'xmlns:a="http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages"';
    
    /*
     * @var string
     */
    private $_xmlns_array  = 'xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"';

    /*
    * GetFulfilmentSupplyOrderSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetFulfilmentSupplyOrder';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Fulfilment\SupplyOrderRequest
     * @return $xml
     */
    public function generateGetFulfilmentSupplyOrderRequestXml($request)
    {
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix('');
        /*
         * Opening tag SupplyOrderRequest
         */

        $xml = $this->_xmlUtil->generateOpenBalise($this->_supplyOrderRequestTag);
        
        if($request->getBeginModificationDate() != null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_beginModificationDateTAG, $request->getBeginModificationDate());
        }
        
        if($request->getEndModificationDate() != null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_endModificationDateTAG, $request->getEndModificationDate());
        }
        
        if($request->getPageNumber() !== null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_pageNumberTAG, $request->getPageNumber());
        }

        if($request->getPageSize() !== null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_pageSizeTAG, $request->getPageSize());
        }
        
        if($request->getSupplyOrderList() != null)
        {
            /*
             * Opening tag SupplyOrderNumberList
             */
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_supplyOrderNumberListTAG);
            
             /** @param \Sdk\Fulfilment\SupplyOrderRequest $request */
            foreach($request->getSupplyOrderList() as $supplyOrder)
            {
                $xml .= $this->_xmlUtil->generateBalise($this->_arrStringTAG, $supplyOrder);
            }
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_supplyOrderNumberListTAG);
        }

        //Closing tag SupplyOrderRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_supplyOrderRequestTag);
        
        return $xml;
    }
}

