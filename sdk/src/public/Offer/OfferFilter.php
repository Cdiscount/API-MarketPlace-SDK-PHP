<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 17:08
 */

namespace Sdk\Offer;


class OfferFilter
{
    private $_pageNumber = 0;
    private $_productList = null;

    /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->_pageNumber;
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->_pageNumber = $pageNumber;
    }

    /**
     * @return array
     */
    public function getProductList()
    {
        return $this->_productList;
    }

    /**
     * @param array $productList
     */
    public function setProductList($productList)
    {
        $this->_productList = $productList;
    }
}