<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:14
 */

namespace Sdk\Soap\Product;

use Sdk\Soap\BaliseTool;

/**
 * The identifier request soap
 */
class IdentifierRequestSoap extends BaliseTool
{
    /**
     * @var \Sdk\Product\IdentifierRequest
     */
    private $_identifierRequest = null;

    /**
     * IdentifierRequestSoap constructor.
     * @param $identifierRequest
     * @internal param string $xmlns
     */
    public function __construct($identifierRequest)
    {
        $this->_xmlns = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"';        
        $this->_identifierRequest = $identifierRequest;
        parent::__construct();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_xmlUtil->generateOpenBalise('identifierRequest');

        // CarrierName
        $xml .= $this->_xmlUtil->generateBalise('IdentifierType', $this->_identifierRequest->getIdentifierType());
        $xml .= $this->_xmlUtil->generateOpenBaliseWithInline('ValueList', array('xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"'));
        foreach ($this->_identifierRequest->getValueList() as $value) {
            $xml .= $this->_xmlUtil->generateBalise('arr:string', $value);
        }
        $xml .= $this->_xmlUtil->generateCloseBalise('ValueList');
        $xml .= $this->_xmlUtil->generateCloseBalise('identifierRequest');
        
        return $xml;
    }
}