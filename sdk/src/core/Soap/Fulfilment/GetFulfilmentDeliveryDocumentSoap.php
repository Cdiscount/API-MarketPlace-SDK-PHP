<?php
/*
 * Created by CDiscount
 * Date: 10/05/2017
 */

namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class GetFulfilmentDeliveryDocumentSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_fulfilmentDeliveryDocumentRequestTag = 'request';
    
    /*
     * @var int
     */
    private $_depositIdTAG = 'DepositId';

   /*
    * GetFulfilmentDeliveryDocumentSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetFulfilmentDeliveryDocument';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Fulfilment\FulfilmentDeliveryDocumentRequest
     * @return string
     */
    public function generateFulfilmentDeliveryDocumentRequestXml($request)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        /*
         * Opening tag FulfilmentDeliveryDocumentRequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_fulfilmentDeliveryDocumentRequestTag);
        if($request->getDepositId() != null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_depositIdTAG,$request->getDepositId());      
        }

        //Balise fermante FulfilmentDeliveryDocumentRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentDeliveryDocumentRequestTag);

        $this->_xmlUtil->setGlobalPrefix('');
        
        return $xml;
    }
}

