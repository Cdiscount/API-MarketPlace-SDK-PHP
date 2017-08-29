<?php

/* 
 * Created by EQUIPE-SQLI
 * Date : 15/05/2017
 * Time : 08:46
 */
namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class GetFulfilmentActivationReportListSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_fulfilmentActivationReportRequestTag = 'request';
    
    /*
     * @var DateTime
     */
    private $_beginDateTAG = 'BeginDate';

     /*
     * @var DateTime
     */
    private $_endDateTAG = 'EndDate';
    
    /*
     * @var array
     */
    private $_depositIdListTAG = 'DepositIdList';

     /*
     * @var int
     */
    private $_intArrayTAG = 'arr:int';

    //namespace for arrays
    private $_xmlns_arr='xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"';
    
    /*
    * GetFulfilmentActivationReportListSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetFulfilmentActivationReportList';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Fulfilment\FulfilmentActivationReportRequest
     * @return string
     */
    public function generateFulfilmentActivationReportRequestXml($request)
    {
        $namespace = 'cdis:';
        $inlines = array($this->_xmlns_arr);
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        /*
         * FulfilmentActivationReportRequest tag
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_fulfilmentActivationReportRequestTag);
        
        if($request->getBeginDate() != null)
        {
            /*
             * BeginDate tag
            */
            $xml .= $this->_xmlUtil->generateBalise($this->_beginDateTAG, $request->getBeginDate());
        }
        
        if($request->getDepositList() != null)
        {
            /*
            * Opening tag DepositIdList
            */
            $xml .= $this->_xmlUtil->generateOpenBaliseWithInLine($this->_depositIdListTAG,$inlines);

            $this->_xmlUtil->setGlobalPrefix('');

            /*
            * @var param $DepositIdList
            */
            foreach($request->getDepositList() as $depositId)
            {
                //Tag int
                $xml .= $this->_xmlUtil->generateBalise($this->_intArrayTAG, $depositId);
            }
            
            $this->_xmlUtil->setGlobalPrefix($namespace);

            //Closing tag DepositIdList
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_depositIdListTAG);
        }
        
        if($request->getEndDate() != null)
        {
            /*
            * EndDate Tag
            */
            $xml .= $this->_xmlUtil->generateBalise($this->_endDateTAG, $request->getEndDate());
        }
        
        //Closing tag FulfilmentActivationReportList
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentActivationReportRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');
        
        return $xml;
    }
}

