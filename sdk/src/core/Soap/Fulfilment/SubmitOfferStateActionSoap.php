<?php
/*
 * Created by CDiscount
 * Date: 18/05/2017
 */

namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class SubmitOfferStateActionSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_offerStateActionRequestTag = 'offerStateRequest';
    
    /*
     * @var string
     */
    private $_sellerProductIdTAG = 'SellerProductId';

    /*
     * @var string
     */
    private $_actionTAG = 'Action';
  
   /*
    * SubmitOfferStateActionSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'SubmitOfferStateAction';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Fulfilment\OfferStateActionRequest
     * @return string
     */
    public function generateOfferStateActionRequestXml($offerStateActionRequest)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        /*
         * Opening tag OfferStateActionRequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_offerStateActionRequestTag);

        if($offerStateActionRequest->getAction() != null)
        {
            //Tag Action
            $xml .= $this->_xmlUtil->generateBalise($this->_actionTAG, $offerStateActionRequest->getAction());
        }

        if($offerStateActionRequest->getSellerProductId() != null)
        {
            // Tag SellerProductId
            $xml .= $this->_xmlUtil->generateBalise($this->_sellerProductIdTAG, $offerStateActionRequest->getSellerProductId());
        }
        
        //Closing tag OfferStateActionRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_offerStateActionRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');

        return $xml;
    }
}

