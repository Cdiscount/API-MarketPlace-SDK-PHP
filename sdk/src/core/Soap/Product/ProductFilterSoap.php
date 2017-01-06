<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:14
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class ProductFilterSoap extends BaliseTool
{
    private $_CategoryCodeTAG = 'CategoryCode';

    /**
     * @var \Sdk\Product\ProductFilter
     */
    private $_productFilter = null;

    /**
     * ProductFilterSoap constructor.
     * @param $productFilter
     * @internal param string $xmlns
     */
    public function __construct($productFilter)
    {
        $this->_xmlns = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"';
        $this->_tag = 'productFilter';
        $this->_productFilter = $productFilter;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, array($this->_xmlns));

        /**
         * Category Code
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_CategoryCodeTAG, $this->_productFilter->getCategoryCode());

        $xml .= $this->_generateCloseBalise();
        return $xml;
    }
}