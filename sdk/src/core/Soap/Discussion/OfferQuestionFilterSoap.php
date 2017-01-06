<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 17:49
 */

namespace Sdk\Soap\Discussion;


use Sdk\Discussion\OfferQuestionFilter;

class OfferQuestionFilterSoap  extends FilterSoap
{

    private $_ProductEANListTAG = 'ProductEANList';

    private $_ProductEANTAG = 'ProductEAN';

    private $_ProductSellerReferenceListTAG = 'ProductSellerReferenceList';

    /**
     * OfferQuestionFilterSoap constructor.
     */
    public function __construct()
    {
        parent::__construct('xmlns:i="http://www.w3.org/2001/XMLSchema-instance"', 'offerQuestionFilter');
    }

    /**
     * @param $child OfferQuestionFilter
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

        /** ProductEANList **/
        if ($child->getProductEanList() == null) {
            $this->_childrens .= $this->_xmlUtil->generateAutoClosingBaliseWithInline($this->_ProductEANListTAG, 'i:nil', 'true');
        }
        else {
            $this->_childrens .= $this->_xmlUtil->generateOpenBalise($this->_ProductEANListTAG);
            foreach ($child->getProductEanList() as $ean) {
                $this->_childrens .= $this->_xmlUtil->generateBalise($this->_ProductEANTAG, $ean);
            }
            $this->_childrens .= $this->_xmlUtil->generateCloseBalise($this->_ProductEANListTAG);
        }

        /** ProductSellerReferenceList **/
        if ($child->getProductSellerReferenceList() == null) {
            $this->_childrens .= $this->_xmlUtil->generateAutoClosingBaliseWithInline($this->_ProductSellerReferenceListTAG, 'i:nil', 'true');
        }
    }
}