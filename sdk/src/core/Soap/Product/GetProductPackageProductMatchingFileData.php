<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 09:09
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class GetProductPackageProductMatchingFileData extends BaliseTool
{

    private $_productPackageFilterTAG = 'productPackageFilter';

    private $_PackageIDTAG = 'PackageID';

    /**
     * GetProductPackageProductMatchingFileData constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetProductPackageProductMatchingFileData';
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