<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 11/10/2016
 * Time: 09:36
 */

namespace Sdk\Soap\Order;


use Sdk\Order\OrderFilter;
use Sdk\Soap\XmlUtils;

class OrderFilterSoap
{
    private $_BeginCreationDateTAG = 'BeginCreationDate';
    private $_BeginModificationDateTAG = 'BeginModificationDate';
    private $_EndCreationDateTAG = 'EndCreationDate';
    private $_EndModificationDateTAG = 'EndModificationDate';

    private $_FetchOrderLinesTAG = 'FetchOrderLines';

    private $_OrderStateEnumTAG = 'OrderStateEnum';

    private $_StatesTAG = 'States';

    private $_tag = 'orderFilter';

    private $_xmlns = '';

    private $_xmlUtil;

    private $_childrens = "";

    public function __construct($xmlns = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"')
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

    public function generateEnclosingBaliseWithChildren()
    {
        $xml = $this->_generateOpeningBalise();
        $xml .= $this->_childrens;
        $xml .= $this->_generateClosingBalise();
        return $xml;
    }

    /**
     * @param $child OrderFilter
     */
    public function serializeChild($child)
    {
        /**
         * Dates
         */
        $beginCreationDateBalise = $this->_serializeDate($child->getBeginCreationDate(), $this->_BeginCreationDateTAG);
        $beginModificationDateBalise = $this->_serializeDate($child->getBeginModificationDate(), $this->_BeginModificationDateTAG);
        $endCreationDateBalise = $this->_serializeDate($child->getEndCreationDate(), $this->_EndCreationDateTAG);
        $endModificationDateBalise = $this->_serializeDate($child->getEndModificationDate(), $this->_EndModificationDateTAG);

        $this->_childrens .= $beginCreationDateBalise . $beginModificationDateBalise . $endCreationDateBalise . $endModificationDateBalise;

        /**
         * FetchOrderLines
         */
        $fetchOrderLinesBalise = $this->_xmlUtil->generateOpenBalise($this->_FetchOrderLinesTAG);
        if ($child->isFetchOrderLines()) {
            $fetchOrderLinesBalise .= 'true';
        }
        else {
            $fetchOrderLinesBalise .= 'false';
        }
        $fetchOrderLinesBalise .= $this->_xmlUtil->generateCloseBalise($this->_FetchOrderLinesTAG);

        $this->_childrens .= $fetchOrderLinesBalise;

        /**
         * States
         */
        $statesBalise = $this->_xmlUtil->generateOpenBalise($this->_StatesTAG);
        foreach ($child->getStates() as $state) {
            $statesBalise .= $this->_xmlUtil->generateBalise($this->_OrderStateEnumTAG, $state);
        }
        $statesBalise .= $this->_xmlUtil->generateCloseBalise($this->_StatesTAG);
        $this->_childrens .= $statesBalise;
    }

    private function _serializeDate($value, $tag)
    {
        if ($value == null) {
            return $this->_xmlUtil->generateAutoClosingBalise($tag, 'i:nil', 'true');
        }
        return $this->_xmlUtil->generateOpenBalise($tag) . $value . $this->_xmlUtil->generateCloseBalise($tag);
    }
}