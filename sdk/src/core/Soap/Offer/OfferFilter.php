<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 16:12
 */

namespace Sdk\Soap\Offer;


use Sdk\Soap\BaliseTool;

class OfferFilter extends BaliseTool
{

    private $offerFilterTAG = 'offerFilter';

    private $OfferPoolIdTAG = 'OfferPoolId';

    private $SellerProductIdListTAG = 'SellerProductIdList';

    private $PageNumberTAG = 'PageNumber';

    /**
     * @var array
     */
    private $_productList = null;

    /**
     * @var \Sdk\Offer\OfferFilter
     */
    private $_offerFilter = null;

    /**
     * OfferFilter constructor.
     * @param $productList
     */
    public function __construct($productList)
    {
        $this->_productList = $productList;
        parent::__construct();
    }

    /**
     * @param $offerFilter
     */
    public function setOfferFilter($offerFilter)
    {
        $this->_offerFilter = $offerFilter;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_xmlUtil->generateOpenBalise($this->offerFilterTAG);

        /** OfferPoolId **/
        $xml .= $this->_xmlUtil->generateBalise($this->OfferPoolIdTAG, 1);

        if ($this->_productList != null) {

            /** SellerProductIdList **/
            $xml .= $this->_xmlUtil->generateOpenBalise($this->SellerProductIdListTAG);
            foreach ($this->_productList as $product) {
                $xml .= $this->_xmlUtil->generateBalise('s:string', $product);
            }
            $xml .= $this->_xmlUtil->generateCloseBalise($this->SellerProductIdListTAG);
        }

        if ($this->_offerFilter != null) {

            /** Page number **/
            $xml .= $this->_xmlUtil->generateBalise($this->PageNumberTAG, $this->_offerFilter->getPageNumber());
        }
        $xml .= $this->_xmlUtil->generateCloseBalise($this->offerFilterTAG);
        return $xml;
    }
}