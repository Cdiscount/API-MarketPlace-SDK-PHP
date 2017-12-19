<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */
 
namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class GetFulfilmentSupplyOrderReportListSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_supplyOrderReportRequestTag = 'request';
    
    /*
     * @var dateTime
     */
    private $_beginCreationDateTAG = 'BeginCreationDate';

    /*
     * @var array
     */
    private $_depositIdListTAG = 'DepositIdList';

    /*
     * @var int
     */
    private $_intArrayTAG = 'arr:int';

    /*
     * @var dateTime
     */
    private $_endCreationDateTAG = 'EndCreationDate';
    
    /*
     * @var int
     */
    private $_pageNumberTAG = 'PageNumber';
  
    /*
     * @var int
     */
    private $_pageSizeTAG = 'PageSize';

    //namespace for arrays
    private $_xmlns_arr='xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"';
  
   /*
    * GetFulfilmentSupplyOrderReportListSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetFulfilmentSupplyOrderReportList';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Fulfilment\SupplyOrderReportRequest
     * @return $xml
     */
    public function generateSupplyOrderReportRequestXml($request)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        
        /*
         * Opening tag SupplyOrderReportRequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_supplyOrderReportRequestTag);
        
        if($request->getBeginCreationDate() != null)
        {
            /*
            * Tag BeginCreationDateTAG
            */
            $xml .= $this->_xmlUtil->generateBalise($this->_beginCreationDateTAG, $request->getBeginCreationDate());
        }
        
        

        if($request->getDepositIdList() != null)
        {
            /*
            * Opening tag DepositIdList
            */
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_depositIdListTAG);

            $this->_xmlUtil->setGlobalPrefix('');
            
            foreach($request->getDepositIdList() as $depositId)
            {
                //Tag int
                $xml .= $this->_xmlUtil->generateBalise($this->_intArrayTAG, $depositId);
            }

             $this->_xmlUtil->setGlobalPrefix($namespace);

            /*
            * Closing tag DepositIdList
            */
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_depositIdListTAG);
        }
        
       
        
        if($request->getEndCreationDate() != null)
        {
            //Tag EndCreationDate
            $xml .= $this->_xmlUtil->generateBalise($this->_endCreationDateTAG, $request->getEndCreationDate());
        }
        
        if($request->getPageNumber() !== null)
        {
            //Tag PageNumber
            $xml .= $this->_xmlUtil->generateBalise($this->_pageNumberTAG, $request->getPageNumber());
        }

        if($request->getPageSize() !== null)
        {
            //Tag PageSize
            $xml .= $this->_xmlUtil->generateBalise($this->_pageSizeTAG, $request->getPageSize());
        }
        
        //Closing tag SupplyOrderReportRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_supplyOrderReportRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');

        return $xml;
    }

    

}

