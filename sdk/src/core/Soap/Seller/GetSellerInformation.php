<?php

/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/10/2016
 * Time: 14:19
 */

namespace Sdk\Soap\Seller;

use Sdk\Soap\XmlUtils;

class GetSellerInformation
{

    private $_tag = 'GetSellerInformation';

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