<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class SubmitFulfilmentOnDemandSupplyOrderSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_fulfilmentOnDemandSupplyOrderRequestTag = 'request';
    
    /*
     * @var array
     */
    private $_orderLineListTAG = 'OrderLineList';

    /*
     * @var string
     */
    private $_fulfilmentOrderLineRequestTAG = 'FulfilmentOrderLineRequest';

    /*
     * @var string
     */
    private $_orderReferenceTAG = 'OrderReference';
    
    /*
     * @var string
     */
    private $_productEanTAG = 'ProductEan';
  
   /*
    * SubmitFulfilmentSupplyOrderSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'SubmitFulfilmentOnDemandSupplyOrder';
        parent::__construct();
    }

    /*
     * @param $request \Sdk\Fulfilment\FulfilmentOnDemandSupplyOrderRequest
     * @return $xml
     */
    public function generateFulfilmentOnDemandSupplyOrderRequestXml($request)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        /*
         * Opening tag FulfilmentOnDemandSupplyOrderRequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_fulfilmentOnDemandSupplyOrderRequestTag);
        /*
         * Opening tag OrderLineList
         */

        if($request->getOrderLineList() != null)
        {
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_orderLineListTAG);
            
            /** @var \Sdk\Fulfilment\FulfilmentOrderLineRequest $fulfilmentOrderLineRequest */
            foreach($request->getOrderLineList() as $fulfilmentOrderLineRequest)
            {
                //Opening tag  fulfilmentOrderLineRequest
                $xml .= $this->_xmlUtil->generateOpenBalise($this->_fulfilmentOrderLineRequestTAG);

                if($fulfilmentOrderLineRequest->getOrderReference() != null)
                {
                    //Tag OrderReference
                    $xml .= $this->_xmlUtil->generateBalise($this->_orderReferenceTAG, $fulfilmentOrderLineRequest->getOrderReference());
                }
                if($fulfilmentOrderLineRequest->getProductEan() != null)
                {
                    //Tag ProductEan
                    $xml .= $this->_xmlUtil->generateBalise($this->_productEanTAG, $fulfilmentOrderLineRequest->getProductEan());
                }
                //Closing tag fulfilmentOrderLineRequest
                $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentOrderLineRequestTAG);
            }
            
            //Closing tag OrderLineList
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_orderLineListTAG);
        }
        
        //Closing tag fulfilmentOnDemandSupplyOrderRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentOnDemandSupplyOrderRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');

        return $xml;
    }
}

