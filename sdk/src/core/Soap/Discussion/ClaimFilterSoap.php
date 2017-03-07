<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 10:39
 */

namespace Sdk\Soap\Discussion;

use Sdk\Discussion\ClaimFilter;

class ClaimFilterSoap extends FilterSoap
{
    /**
     * @var string TAG
     */
    private $_OnlyWithMessageFromCdsCustomerServiceTAG = 'OnlyWithMessageFromCdsCustomerService';

    /**
     * ClaimFilterSoap constructor.
     * @param array $optionalsNamespaces
     */
    public function __construct($optionalsNamespaces)
    {
        if (isset($optionalsNamespaces)) {
            foreach ($optionalsNamespaces as $namespace) {
                if ($this->startsWith($namespace, 'xmlns:cdis')) {
                    $this->specificConstructor('cdis:', 'orderClaimFilter');
                    break;
                }
            }
        }
        else {
            parent::__construct('xmlns:i="http://www.w3.org/2001/XMLSchema-instance"', 'orderClaimFilter');
        }
    }

    /**
     * @param $child ClaimFilter
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
        else {
            /**
             * Order number list
             */
            /** @var string $orderNumber */
            foreach ($child->getOrderNumberList() as $orderNumber) {

                $globalPrefix = $this->_xmlUtil->getGlobalPrefix();
                $this->_xmlUtil->setGlobalPrefix('');

                $this->_childrens .= $this->_xmlUtil->generateOpenBalise($this->_OrderNumberListTAG);
                $this->_childrens .= $this->_xmlUtil->generateBalise($this->_StringTAG, $orderNumber);
                $this->_childrens .= $this->_xmlUtil->generateCloseBalise($this->_OrderNumberListTAG);

                $this->_xmlUtil->setGlobalPrefix($globalPrefix);
            }
        }

        if (!$child->isOnlyMessageFromCDSCustomerService()) {
            $this->_childrens .= $this->_xmlUtil->generateBalise($this->_OnlyWithMessageFromCdsCustomerServiceTAG, 'false');
        }
        else {
            $this->_childrens .= $this->_xmlUtil->generateBalise($this->_OnlyWithMessageFromCdsCustomerServiceTAG, 'true');
        }
    }
}