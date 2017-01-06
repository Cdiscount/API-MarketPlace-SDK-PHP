<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 17:50
 */

namespace Sdk\Soap\Offer;


use Sdk\Soap\BaliseTool;

class GetOfferPackageSubmissionResult extends BaliseTool
{

    private $_productPackageFilterTAG = 'offerPackageFilter';

    private $_PackageIDTAG = 'PackageID';

    /**
     * GetOfferPackageSubmissionResult constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetOfferPackageSubmissionResult';
        parent::__construct();
    }

    /**
     * @param $packageId
     * @return string
     */
    public function generatePackageFilterXML($packageId)
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_productPackageFilterTAG, array('xmlns:i="http://www.w3.org/2001/XMLSchema-instance"'));

        $xml .= $this->_xmlUtil->generateBalise($this->_PackageIDTAG, $packageId);

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_productPackageFilterTAG);

        return $xml;
    }
}