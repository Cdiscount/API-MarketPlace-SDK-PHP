<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/10/2016
 * Time: 16:26
 */

namespace Sdk\Soap\Common;


use Sdk\Soap\XmlUtils;

class Body
{

    /**
     * @var string
     */
    private $_tag = 'Body';

    /**
     * Body constructor.
     */
    public function __construct()
    {
        $this->_xmlUtil = new XmlUtils('s:');
    }

    /**
     * @param $child
     * @return string
     */
    public function generateXML($child)
    {

        $xml = $this->_xmlUtil->generateOpenBalise($this->_tag);
        $xml .= $child;
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_tag);

        return $xml;
    }
}