<?php
/**
 * Created by Driss kelmous
 * Date: 17/10/2016
 * Time: 13:27
 */

namespace Sdk\Soap\Fulfilment;


use Sdk\Soap\BaliseTool;


class GetFulfilmentOrderListToSupplySoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_fulfilmentOnDemandOrderLineRequestTag = 'request';

    /*
     * @var string
     */
    private $_orderReferenceTAG = 'OrderReference';
    
    /*
     * @var string
     */
    private $_productEanTAG = 'ProductEan';
    
    /*
     * @var string
     */
    private $_warehouseTAG = 'Warehouse';

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetFulfilmentOrderListToSupply';
        parent::__construct();
    }

    /*
     * @param $request \Sdk\Fulfillment\FulfilmentOnDemandOrderLineFilter
     * @return $xml
     */
    public function generateFulfilmentOnDemandOrderLineRequestXml($request)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        
        /*
         * //Opening tag FulfilmentOnDemandOrderLineFilter
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_fulfilmentOnDemandOrderLineRequestTag);
        if($request->getOrderReference() != null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_orderReferenceTAG,$request->getOrderReference());
        }

        if($request->getProductEan() != null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_productEanTAG,$request->getProductEan());      
        }

        if($request->getWarehouse() != null)
        {
            $xml .= $this->_xmlUtil->generateBalise($this->_warehouseTAG,$request->getWarehouse());
        }

        //Closing tag FulfillmentProductRequest
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_fulfilmentOnDemandOrderLineRequestTag);


        $this->_xmlUtil->setGlobalPrefix('');
        
        return $xml;
    }
}