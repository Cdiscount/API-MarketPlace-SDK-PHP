<?php

/* 
 * Created by Cdiscount
 * Date : 18/01/2017
 * Time : 15:46
 */
namespace Sdk\Soap\Order;

use Sdk\Soap\BaliseTool;

class ManageParcelSoap extends BaliseTool
{
    /*
     * @var string
     */
    private $_manageParcelRequestTag = 'manageParcelRequest';
    
    /*
     * @var string
     */
    private $_scopusIdTAG = 'ScopusId';
    
    /*
     * @var string
     */
    private $_parcelActionsListTAG = 'ParcelActionsList';
    
    /*
     * @var string
     */
    private $_parcelInfosTAG = 'ParcelInfos';
    
    /*
     * @var string
     */
    private $_parcelNumberTAG = 'ParcelNumber';
    
    /*
     * @var string
     */
    private $_manageParcelTAG = 'ManageParcel';
    
    /*
     * @var string
     */
    private $_skuTAG = 'Sku';
    
    /*
    * ManageParcelSoap constructor
    * @param string $xmlns
    */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"') 
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'ManageParcel';
        parent::__construct();
    }
    
    /*
     * @param $request \Sdk\Order\ManageParcelRequest
     */
    public function generateManageParcelRequestXml($request)
    {
        $namespace = 'cdis:';
        /*
         * @param $namespace
         */        
        $this->_xmlUtil->setGlobalPrefix($namespace);
        /*
         * balise ouvrante ManageParcelrequest
         */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_manageParcelRequestTag);
        
        /*
         * Balise ouvrante ParcelActionsList
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_parcelActionsListTAG);
        /*
         * @var param $parcelInfos \Sdk\Order\ParcelInfos
         */
        foreach($request->getParcelActionsList() as $parcelInfos)
        {
            //balise ouvrante parcelInfos
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_parcelInfosTAG);
            
            //balise manageParcel
            $xml .= $this->_xmlUtil->generateBalise($this->_manageParcelTAG, $parcelInfos->getManageParcel());
            
            //Balise ParcelNumber
            $xml .= $this->_xmlUtil->generateBalise($this->_parcelNumberTAG, $parcelInfos->getParcelNumber());
            
            //Balise Sku
            $xml .= $this->_xmlUtil->generateBalise($this->_skuTAG, $parcelInfos->getSku());
            
            //Balise fermante ParcelInfo
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_parcelInfosTAG);
        }
        
        //Balise fermante ParcelActionsList
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_parcelActionsListTAG);
        
        /*
         * Balise scopusId
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_scopusIdTAG, $request->getScopusId());
        
        //balise fermante ManageParcel
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_manageParcelRequestTag);
        
        $this->_xmlUtil->setGlobalPrefix('');
        
        return $xml;
    }
}

