<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 14:17
 */

namespace Sdk\Soap\Order;


use Sdk\Soap\BaliseTool;

class ValidateOrderLineSoap extends BaliseTool
{

    private $_AcceptationStateTAG = 'AcceptationState';
    private $_ProductConditionTAG = 'ProductCondition';
    private $_SellerProductIdTAG = 'SellerProductId';

    /**
     * @var \Sdk\Order\ValidateOrderLine
     */
    private $_validateOrderLine = null;

    public function __construct($validateOrderLine)
    {
        $this->_validateOrderLine = $validateOrderLine;
        $this->_tag = 'ValidateOrderLine';
        parent::__construct();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_generateOpenBalise();

        $xml .= $this->_xmlUtil->generateBalise($this->_AcceptationStateTAG, $this->_validateOrderLine->getAcceptationState());
        $xml .= $this->_xmlUtil->generateBalise($this->_ProductConditionTAG, $this->_validateOrderLine->getProductCondition());
        $xml .= $this->_xmlUtil->generateBalise($this->_SellerProductIdTAG, $this->_validateOrderLine->getSellerProductId());

        $xml .= $this->_generateCloseBalise();
        return $xml;
    }
}