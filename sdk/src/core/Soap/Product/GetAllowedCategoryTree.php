<?php

namespace Sdk\Soap\Product;
use Sdk\Soap\XmlUtils;

/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 15:22
 */
class GetAllowedCategoryTree
{
    private $_tag = 'GetAllowedCategoryTree';

    private $_xmlns = '';

    private $_xmlUtil;

    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_xmlUtil = new XmlUtils('');
    }

    private function _generateOpeningBalise()
    {
        $inlines = array($this->_xmlns);

        return $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, $inlines);
    }

    private function _generateClosingBalise()
    {
        return $this->_xmlUtil->generateCloseBalise($this->_tag);
    }

    public function generateEnclosingBalise($child)
    {
        $xml = $this->_generateOpeningBalise();
        $xml .= $child;
        $xml .= $this->_generateClosingBalise();
        return $xml;
    }
}