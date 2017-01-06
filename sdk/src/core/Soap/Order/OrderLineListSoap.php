<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 14:18
 */

namespace Sdk\Soap\Order;


use Sdk\Soap\BaliseTool;

class OrderLineListSoap extends BaliseTool
{

    /**
     * @var \Sdk\Order\OrderLineList
     */
    private $_validateOrderLines = null;

    public function __construct($validateOrderLines)
    {
        $this->_tag = 'OrderLineList';
        $this->_validateOrderLines = $validateOrderLines;
        parent::__construct();
    }

    /**
     * @param $validateOrderLines
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_generateOpenBalise();

        /** @var \Sdk\Order\ValidateOrderLine $validateOrderLine */
        foreach ($this->_validateOrderLines->getOrderLines() as $validateOrderLine) {

            $validateOrderLineSoap = new ValidateOrderLineSoap($validateOrderLine);
            $xml .= $validateOrderLineSoap->serialize();

        }

        $xml .= $this->_generateCloseBalise();

        return $xml;
    }


}