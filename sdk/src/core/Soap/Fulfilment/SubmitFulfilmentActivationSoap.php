<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */
 
namespace Sdk\Soap\Fulfilment;

use Sdk\Soap\BaliseTool;

class SubmitFulfilmentActivationSoap extends BaliseTool
{
    private $_submitFulfilmentActivationRequestTag = 'cdis:request';

    private $_productActivationListTAG = 'cdis:ProductList';

    private $_productActivationDataTAG = 'cdis2:ProductActivationData';

    private $_actionTAG = 'cdis2:Action';

    private $_heightTAG = 'cdis2:Height';

    private $_lengthTAG = 'cdis2:Length';

    private $_productEANTAG = 'cdis2:ProductEan';

    private $_sellerProductReferenceTAG = 'cdis2:SellerProductReference';

    private $_weightTAG = 'cdis2:Weight';

    private $_widthTAG = 'cdis2:Width';

    private $_xmlns_cdis2  = 'xmlns:cdis2="http://schemas.datacontract.org/2004/07/Cdiscount.Service.Marketplace.API.External.Contract.Data.Fulfilment"';

    /*
    * SubmitFulfilmentActivationSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'SubmitFulfilmentActivation';
        parent::__construct();
    }

    /*
     * @param $request \Sdk\Fulfilment\SubmitFulfilmentActivationRequest
     * @return string
     */
    public function generateFulfilmentActivationRequestXml($request)
    {
        $inlines = array($this->_xmlns_cdis2);
        /*
         * Opening tag FulfilmentSupplyOrderRequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_submitFulfilmentActivationRequestTag);
        
        if($request->getProductActivationList() !=null)
        {
            /*
            * Opening tag ProductActivationList
            */
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_productActivationListTAG);

            foreach($request->getProductActivationList() as $productActivation)
            {
                //Opening tag ProductActivationData
                $xml .= $this->_xmlUtil->generateOpenBalise($this-> _productActivationDataTAG);
                if($productActivation->getAction() != null)
                {
                    //Tag Action
                    $xml .= $this->_xmlUtil->generateBalise($this->_actionTAG, $productActivation->getAction());
                }

                if($productActivation->getHeight() != null)
                {
                    //Tag Height
                    $xml .= $this->_xmlUtil->generateBalise($this->_heightTAG, $productActivation->getHeight());
                }

                if($productActivation->getLength() != null)
                {
                    //Tag Length
                    $xml .= $this->_xmlUtil->generateBalise($this->_lengthTAG, $productActivation->getLength());
                }

                if($productActivation->getProductEAN() != null)
                {
                    //Tag ProductEAN
                    $xml .= $this->_xmlUtil->generateBalise($this->_productEANTAG, $productActivation->getProductEAN());
                }

                if($productActivation->getSellerProductReference() != null)
                {
                    //Tag SellerProductReference
                    $xml .= $this->_xmlUtil->generateBalise($this->_sellerProductReferenceTAG, $productActivation->getSellerProductReference());
                }

                if($productActivation->getWeight() != null)
                {
                    //Tag Weight
                    $xml .= $this->_xmlUtil->generateBalise($this->_weightTAG, $productActivation->getWeight());
                }

                if($productActivation->getWidth() != null)
                {
                    //Tag Width
                    $xml .= $this->_xmlUtil->generateBalise($this->_widthTAG, $productActivation->getWidth());
                }

                //Closing tag ProductActivationData
                $xml .= $this->_xmlUtil->generateCloseBalise($this-> _productActivationDataTAG);
        }

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_productActivationListTAG);
        }
        

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_submitFulfilmentActivationRequestTag);

        $this->_xmlUtil->setGlobalPrefix('');

        return $xml;
    }
}