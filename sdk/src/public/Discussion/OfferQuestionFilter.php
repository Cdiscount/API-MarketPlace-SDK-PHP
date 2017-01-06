<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 17:42
 */

namespace Sdk\Discussion;


class OfferQuestionFilter extends DiscussionFilter
{
    /**
     * @var array
     */
    private $_productEanList = null;

    /**
     * @return array
     */
    public function getProductEanList()
    {
        return $this->_productEanList;
    }

    /**
     * @param $productEan
     */
    public function addProductEan($productEan)
    {
        if ($this->_productEanList == null) {
            $this->_productEanList = array();
        }
        array_push($this->_productEanList, $productEan);
    }

    /**
     * OfferQuestionFilter constructor.
     */
    public function __construct()
    {
        $this->_statusList = array();

    }

    /**
     * @var array
     */
    private $_productSellerReferenceList = null;

    /**
     * @return array
     */
    public function getProductSellerReferenceList()
    {
        return $this->_productSellerReferenceList;
    }

    /**
     * @param $productSellerReference
     */
    public function addProductSellerReference($productSellerReference)
    {
        if ($this->_productSellerReferenceList == null) {
            $this->_productSellerReferenceList = array();
        }
        array_push($this->_productSellerReferenceList, $productSellerReference);
    }
}