<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 15:23
 */

namespace Sdk\Soap\Offer;


use Sdk\Soap\BaliseTool;

class SubmitOfferPackage extends BaliseTool
{

    private $productPackageRequestTAG = 'offerPackageRequest';

    private $ZipFileFullPathTAG = 'ZipFileFullPath';

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'SubmitOfferPackage';
        parent::__construct();
    }

    /**
     * @param $zipURL
     * @return string XML
     */
    public function generatePackageRequestXML($zipURL)
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->productPackageRequestTAG, array('xmlns:i="http://www.w3.org/2001/XMLSchema-instance"'));

        $xml .= $this->_xmlUtil->generateBalise($this->ZipFileFullPathTAG, $zipURL);

        $xml .= $this->_xmlUtil->generateCloseBalise($this->productPackageRequestTAG);

        return $xml;
    }
}