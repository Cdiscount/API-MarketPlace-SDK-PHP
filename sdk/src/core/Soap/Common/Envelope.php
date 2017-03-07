<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * History : 
 * MSajid : add new method addNameSpace
 * Date: 03/10/2016
 * Time: 15:03
 */

namespace Sdk\Soap\Common;


use Sdk\Soap\XmlUtils;

class Envelope
{

    /**
     * @var string
     */
    private $_tag = 'Envelope';

    private $_xmlns = '';

    /**
     * Envelope constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns:s="http://schemas.xmlsoap.org/soap/envelope/"')
    {
        $this->_xmlns = $xmlns;
        $this->_xmlUtil = new XmlUtils('s:');
    }

    /**
     * @param $child
     * @return string
     */
    public function generateXML($child)
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_tag, array($this->_xmlns));
        $xml .= $child;
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_tag);

        return $xml;
    }

    /**
     * Add a new namespace
     *
     * @param $xmlns
     */
    public function addNameSpace($xmlns)
    {
        $this->_xmlns .= ' ' . $xmlns;
    }
}