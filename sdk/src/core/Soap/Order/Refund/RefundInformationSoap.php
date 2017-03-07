<?php

/*
 * Created by CDiscount
 * Date: 31/01/2017
 * Time: 15:13
 */

namespace Sdk\Soap\Order\Refund;
use Sdk\Soap\BaliseTool;
/**
 * class contains refund information tags
 * @author mohammed.sajid
 */
class RefundInformationSoap extends BaliseTool
{
    /*
     * @var stting
     */
    private $_amountTAG = 'Amount';
    
    /*
     * @var string
     */
    private $_motiveIdTAG = 'MotiveId';
    
    /*
     * @var \Sdk\Order\Refund\RefundInformation
     */
    private $_refundInformation = null;
    
    /*
     * RefundInformationSoap constructor
     * @param $refundInformation \Sdk\Order\Refund\RefundInformation
     */
    public function __construct($refundInformation) 
    {
        $this->_refundInformation = $refundInformation;
        $this->_tag = 'RefundInformation';
        parent::__construct();
    }
    
    /*
     * generate xml from request values
     */
    public function serialize()
    {
        $xml = $this->_generateOpenBalise();
        /*
         * Amount
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_amountTAG, $this->_refundInformation->getAmount());
        
        /*
         * MotiveId
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_motiveIdTAG, $this->_refundInformation->getMotiveId());
        
        $xml .= $this->_generateCloseBalise();
        
        return $xml;
    }
}
