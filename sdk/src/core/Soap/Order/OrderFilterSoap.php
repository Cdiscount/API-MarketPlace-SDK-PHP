<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 11/10/2016
 * Time: 09:36
 */

namespace Sdk\Soap\Order;


use Sdk\Order\OrderFilter;
use Sdk\Soap\Discussion\FilterSoap;
use Sdk\Soap\XmlUtils;

class OrderFilterSoap extends FilterSoap
{
    private $_FetchOrderLinesTAG = 'FetchOrderLines';
    
    private $_OrderStateEnumTAG = 'OrderStateEnum';
    
    private $_StatesTAG = 'States';
    /*
     * @var partner order ref string tag
     */
    private $_partnerOrderRefTAG = 'PartnerOrderRef';
    /*
     * @var orderType enum tag
     */
    private $_orderTypeTAG = 'OrderType';
    
    /*
     * @var fetch parcels boolean tag
     */
    private $_fetchParcelsTAG = 'FetchParcels';
    
    /**
     * @var string
     */
    private $_orderReferenceListTAG = 'OrderReferenceList';
    
    /**
     * Prefix for string tag
     * @var string
     */
    private $_stringTAG = 'd5p1:string';

    /**
     * ClaimFilterSoap constructor.
     * @param array $optionalsNamespaces
     */
    public function __construct($optionalsNamespaces)
    {
        if (isset($optionalsNamespaces)) {
            foreach ($optionalsNamespaces as $namespace) {
                if ($this->startsWith($namespace, 'xmlns:cdis')) {
                    $this->specificConstructor('cdis:', 'orderFilter');
                    break;
                }
            }
        }
        else {
            parent::__construct('xmlns:i="http://www.w3.org/2001/XMLSchema-instance"', 'orderFilter');
        }
    }

    /**
     * @param $child OrderFilter
     */
    public function serializeChild($child)
    {
        /**
         * Dates
         */
        $beginCreationDateBalise = null;
        if ($child->getBeginCreationDate() != NULL) {
            $beginCreationDateBalise .= $this->_serializeDate($child->getBeginCreationDate(), $this->_BeginCreationDateTAG);
        }
        
        $beginModificationDateBalise = null;
        if ($child->getBeginModificationDate() != NULL) {
            $beginModificationDateBalise .= $this->_serializeDate($child->getBeginModificationDate(), $this->_BeginModificationDateTAG);
        }
        
        $endCreationDateBalise = null;
        if ($child->getEndCreationDate() != NULL) {
            $endCreationDateBalise .= $this->_serializeDate($child->getEndCreationDate(), $this->_EndCreationDateTAG);
        }
        
        $endModificationDateBalise = null;
        if ($child->getEndModificationDate() != NULL) {
            $endModificationDateBalise .= $this->_serializeDate($child->getEndModificationDate(), $this->_EndModificationDateTAG);
        }
        
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
        
        /*
         * fetch parcels
         */
        $fetchParcelsBalise = $this->_xmlUtil->generateOpenBalise($this->_fetchParcelsTAG);
        if ($child->isFetchParcels()) {
            $fetchParcelsBalise .= 'true';
        }else {
            $fetchParcelsBalise .= 'false';
        }
        $fetchParcelsBalise .= $this->_xmlUtil->generateCloseBalise($this->_fetchParcelsTAG);
        $this->_childrens .= $fetchParcelsBalise;
        
        /*
         * OrderreferenceList
         */
        $orderReferenceList = $child->getOrderReferenceList();
        if ( isset($orderReferenceList) && count($orderReferenceList) > 0 ) {
            $orderReferenceListBalise = $this->_xmlUtil->generateOpenBalise($this->_orderReferenceListTAG);
        
            $orderRefs = "";

            /**
             * Parsing over orderRef
             */
            /** @var string $orderReference */
            foreach ($orderReferenceList as $orderReference) {

                $globalPrefix = $this->_xmlUtil->getGlobalPrefix();
                $this->_xmlUtil->setGlobalPrefix('');

                $orderRefs .= $this->_xmlUtil->generateOpenBalise($this->_stringTAG);
                $orderRefs .= $orderReference;
                $orderRefs .= $this->_xmlUtil->generateCloseBalise($this->_stringTAG);

                $this->_xmlUtil->setGlobalPrefix($globalPrefix);
            }
         
            $orderReferenceListBalise .= $orderRefs;

            $orderReferenceListBalise .= $this->_xmlUtil->generateCloseBalise($this->_orderReferenceListTAG);
            $this->_childrens .= $orderReferenceListBalise;       
        }
             
        /*
         * order type
         */
        if ($child->getOrderType() != \Sdk\Order\OrderTypeEnum::None) {
            $this->_childrens .= $this->_xmlUtil->generateBalise($this->_orderTypeTAG, $child->getOrderType());
        }
        
        /*
         * PartnerOrderRef
         */
        if ($child->getPartnerOrderRef() != NULL) {
           $this->_childrens .= $this->_xmlUtil->generateBalise($this->_partnerOrderRefTAG, $child->getPartnerOrderRef()); 
        }
              
        /**
         * States
         */
        if ($child->getStates() != NULL) {
           $statesBalise = $this->_xmlUtil->generateOpenBalise($this->_StatesTAG);
            foreach ($child->getStates() as $state) {
                $statesBalise .= $this->_xmlUtil->generateBalise($this->_OrderStateEnumTAG, $state);
            }
            $statesBalise .= $this->_xmlUtil->generateCloseBalise($this->_StatesTAG);
            $this->_childrens .= $statesBalise; 
        } 
    }
}