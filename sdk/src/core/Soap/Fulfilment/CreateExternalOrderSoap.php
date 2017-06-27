<?php

/* 
 * Created by El Ibaoui Otmane (SQLI)
 * Date : 08/05/2017
 * Time : 12:14
 */
namespace Sdk\Soap\Fulfillment;

use Sdk\Soap\BaliseTool;

class CreateExternalOrderSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_requestTag = 'cdis:request';

    /*
     * @var string
     */
    private $_orderTag = 'cdis2:Order';

    /*
     * @var string
     */
    private $_commentsTag = 'cdis2:Comments';

    /*
     * @var string
     */
    private $_corporationTag = 'cdis2:Corporation';

    /*
     * @var string
     */
    private $_customerTag = 'cdis2:Customer';
    /*
     * @var string
     */
    private $_additionalShippingAddressTag = 'cdis2:AdditionalShippingAddress';

    /*
     * @var string
     */
    private $_cellPhoneNumberTag = 'cdis2:CellPhoneNumber';

    /*
     * @var string
     */
    private $_civilityTag = 'cdis2:Civility';

    /*
     * @var string
     */
    private $_customerEmailAddressTag = 'cdis2:CustomerEmailAddress';

    /*
     * @var string
     */
    private $_customerFirstNameTag = 'cdis2:CustomerFirstName';

    /*
     * @var string
     */
    private $_customerLastNameTag = 'cdis2:CustomerLastName';

    /*
     * @var string
     */
    private $_landlinePhoneNumberTag = 'cdis2:LandlinePhoneNumber';

    /*
     * @var string
     */
    private $_localityTag = 'cdis2:Locality';

    /*
     * @var string
     */
    private $_shippingAddressTag = 'cdis2:ShippingAddress';
    
    /*
     * @var string
     */
    private $_shippingAddressTitleTag = 'cdis2:ShippingAddressTitle';

    /*
     * @var string
     */
    private $_shippingCityTag = 'cdis2:ShippingCity';

    /*
     * @var string
     */
    private $_shippingCountryTag = 'cdis2:ShippingCountry';

    /*
     * @var string
     */
    private $_shippingPostalCodeTag = 'cdis2:ShippingPostalCode';

    /*
     * @var string
     */
    private $_customerOrderNumberTag = 'cdis2:CustomerOrderNumber';

    /*
     * @var string
     */
    private $_orderDateTag = 'cdis2:OrderDate';

    /*
     * @var string
     */
    private $_orderLineListTag = 'cdis2:OrderLineList';

    /*
     * @var string
     */
    private $_externalOrderLineTag = 'cdis2:ExternalOrderLine';

    /*
     * @var string
     */
    private $_productEanTag = 'cdis2:ProductEan';

    /*
     * @var string
     */
    private $_productReferenceTag = 'cdis2:ProductReference';

    
    /*
     * @var string
     */
    private $_quantityTag = 'cdis2:Quantity';

    /*
     * @var string
     */
    private $_shippingModeTag = 'cdis2:ShippingMode';


    /*
    * Name Space
    */
    private $_xmlns_array  = 'xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"';
    private $_xmlns_cdis2  ='xmlns:cdis2="http://schemas.datacontract.org/2004/07/Cdiscount.Service.Marketplace.API.External.Contract.Data.Order"';
    
    /**
     * CreateExternalOrder constructor.
     * @param $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'CreateExternalOrder';
        parent::__construct();
    }

     /*
     * @param $request \Sdk\Fulfilment\OrderIntegrationRequest
     */
    public function generateFulfillmentProductRequestXml($request)
    {
        $inlines = array($this->_xmlns_array,$this->_xmlns_cdis2);
        /*
         * Balise Open request
         */
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_requestTag, $inlines);

        /*
         * Balise Open order
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_orderTag);
       
            //Balise Comments
            $xml .= $this->_xmlUtil->generateBalise($this->_commentsTag, $request->getExternalOrder()->getComments());
            //Balise Corporation
            $xml .= $this->_xmlUtil->generateBalise($this->_corporationTag, $request->getExternalOrder()->getCorporation());
            //Balise Open Customer
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_customerTag);

                $xml .= $this->_xmlUtil->generateBalise($this->_additionalShippingAddressTag, $request->getExternalOrder()->getExternalCustomer()->getAdditionalShippingAddress());
                $xml .= $this->_xmlUtil->generateBalise($this->_cellPhoneNumberTag, $request->getExternalOrder()->getExternalCustomer()->getCellPhoneNumber());
                $xml .= $this->_xmlUtil->generateBalise($this->_civilityTag, $request->getExternalOrder()->getExternalCustomer()->getCivility());
                $xml .= $this->_xmlUtil->generateBalise($this->_customerEmailAddressTag, $request->getExternalOrder()->getExternalCustomer()->getCustomerEmailAddress());
                $xml .= $this->_xmlUtil->generateBalise($this->_customerFirstNameTag, $request->getExternalOrder()->getExternalCustomer()->getCustomerFirstName());
                $xml .= $this->_xmlUtil->generateBalise($this->_customerLastNameTag, $request->getExternalOrder()->getExternalCustomer()->getCustomerLastName());
                $xml .= $this->_xmlUtil->generateBalise($this->_landlinePhoneNumberTag, $request->getExternalOrder()->getExternalCustomer()->getLandlinePhoneNumber());
                $xml .= $this->_xmlUtil->generateBalise($this->_localityTag, $request->getExternalOrder()->getExternalCustomer()->getLocality());
                $xml .= $this->_xmlUtil->generateBalise($this->_shippingAddressTag, $request->getExternalOrder()->getExternalCustomer()->getShippingAddress());
                $xml .= $this->_xmlUtil->generateBalise($this->_shippingAddressTitleTag, $request->getExternalOrder()->getExternalCustomer()->getShippingAddressTitle());
                $xml .= $this->_xmlUtil->generateBalise($this->_shippingCityTag, $request->getExternalOrder()->getExternalCustomer()->getShippingCity());
                $xml .= $this->_xmlUtil->generateBalise($this->_shippingCountryTag, $request->getExternalOrder()->getExternalCustomer()->getShippingCountry());
                $xml .= $this->_xmlUtil->generateBalise($this->_shippingPostalCodeTag, $request->getExternalOrder()->getExternalCustomer()->getShippingPostalCode());

            //Balise Close Customer
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_customerTag);
            //Balise CustomerOrderNumber
            $xml .= $this->_xmlUtil->generateBalise($this->_customerOrderNumberTag, $request->getExternalOrder()->getCustomerOrderNumber());
            //Balise OrderDate
            $xml .= $this->_xmlUtil->generateBalise($this->_orderDateTag, $request->getExternalOrder()->getOrderDate());

            //Balise Open OrderLineList
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_orderLineListTag);
                if(count($request->getExternalOrder()->getExternalOrderLine()) > 1)
                {
                    foreach($request->getExternalOrder()->getExternalOrderLine() as $orderLine)
                    {
                        //Balise Open ExternalOrderLine
                        $xml .= $this->_xmlUtil->generateOpenBalise($this->_externalOrderLineTag);
                            //Balise  ProductEan
                            $xml .= $this->_xmlUtil->generateBalise($this->_productEanTag, $orderLine->getProductEan());
                            //Balise  ProductReference
                            $xml .= $this->_xmlUtil->generateBalise($this->_productReferenceTag,$orderLine->getProductReference());
                            //Balise  Quantity
                            $xml .= $this->_xmlUtil->generateBalise($this->_quantityTag, $orderLine->getQuantity());
                        //Balise Close ExternalOrderLine
                        $xml .= $this->_xmlUtil->generateCloseBalise($this->_externalOrderLineTag);
                    }
                }
                else
                {
                    $fistElement = array_values($request->getExternalOrder()->getExternalOrderLine())[0];
                     //Balise Open ExternalOrderLine
                        $xml .= $this->_xmlUtil->generateOpenBalise($this->_externalOrderLineTag);
                            //Balise  ProductEan
                            $xml .= $this->_xmlUtil->generateBalise($this->_productEanTag, $fistElement->getProductEan());
                            //Balise  ProductReference
                            $xml .= $this->_xmlUtil->generateBalise($this->_productReferenceTag, $fistElement->getProductReference());
                            //Balise  Quantity
                            $xml .= $this->_xmlUtil->generateBalise($this->_quantityTag, $fistElement->getQuantity());
                        //Balise Close ExternalOrderLine
                        $xml .= $this->_xmlUtil->generateCloseBalise($this->_externalOrderLineTag);
                }
                
            //Balise Close OrderLineList
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_orderLineListTag);
            //balise  ShippingMode
            $xml .= $this->_xmlUtil->generateBalise($this->_shippingModeTag, $request->getExternalOrder()->getShippingMode());
        //Balise Close Order
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_orderTag);

        //Balise Close Request
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_requestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');
        return $xml;

    }
}
