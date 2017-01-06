<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 15:11
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class GetProductPackageSubmissionResult extends BaliseTool
{

    private $_productPackageFilterTAG = 'productPackageFilter';

    private $_PackageIDTAG = 'PackageID';

    /**
     * GetProductPackageSubmissionResult constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetProductPackageSubmissionResult';
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