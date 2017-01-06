<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 16:41
 */

namespace Sdk\Soap\Discussion;

use Sdk\Discussion\OrderQuestionFilter;

class OrderQuestionFilterSoap extends FilterSoap
{
    /**
     * OrderQuestionFilterSoap constructor.
     */
    public function __construct()
    {
        parent::__construct('xmlns:i="http://www.w3.org/2001/XMLSchema-instance"', 'orderQuestionFilter');
    }

    /**
     * @param $child OrderQuestionFilter
     */
    public function serializeChild($child)
    {
        /** Dates **/
        $beginCreationDateBalise = $this->_serializeDate($child->getBeginCreationDate(), $this->_BeginCreationDateTAG);
        $beginModificationDateBalise = $this->_serializeDate($child->getBeginModificationDate(), $this->_BeginModificationDateTAG);
        $endCreationDateBalise = $this->_serializeDate($child->getEndCreationDate(), $this->_EndCreationDateTAG);
        $endModificationDateBalise = $this->_serializeDate($child->getEndModificationDate(), $this->_EndModificationDateTAG);

        $this->_childrens .= $beginCreationDateBalise . $beginModificationDateBalise . $endCreationDateBalise . $endModificationDateBalise;

        /** Status **/
        $this->_childrens .= $this->_xmlUtil->generateOpenBalise($this->_StatusListTAG);
        foreach ($child->getStatusList() as $status) {
            $this->_childrens .= $this->_xmlUtil->generateBalise($this->_DiscussionStateFilterTAG, $status);
        }
        $this->_childrens .= $this->_xmlUtil->generateCloseBalise($this->_StatusListTAG);

        if ($child->getOrderNumberList() == null) {
            $this->_childrens .= $this->_xmlUtil->generateAutoClosingBaliseWithInline($this->_OrderNumberListTAG, 'i:nil', 'true');
        }
    }
}