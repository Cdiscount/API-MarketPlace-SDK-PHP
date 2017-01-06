<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 11:29
 */

namespace Sdk\Soap\Product;


use Sdk\Soap\BaliseTool;

class ModelFilterSoap extends BaliseTool
{
    private $_CategoryCodeTAG = 'a:string';

    private $_CategoryCodeListTAG = 'CategoryCodeList';

    /**
     * @var \Sdk\Product\ModelFilter
     */
    private $_modelFilter = null;

    /**
     * ProductFilterSoap constructor.
     * @param $modelFilter
     * @internal param string $xmlns
     */
    public function __construct($modelFilter)
    {
        $this->_xmlns = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"';
        $this->_tag = 'modelFilter';
        $this->_modelFilter = $modelFilter;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, array($this->_xmlns));

        // CategoryCodeLst
        $xml .= $this->_xmlUtil->generateOpenBaliseWithInline($this->_CategoryCodeListTAG, array('xmlns:a="http://schemas.microsoft.com/2003/10/Serialization/Arrays"'));

        // Category Code
        $xml .= $this->_xmlUtil->generateBalise($this->_CategoryCodeTAG, $this->_modelFilter->getCategoryCode());

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_CategoryCodeListTAG);

        $xml .= $this->_generateCloseBalise();
        return $xml;
    }
}