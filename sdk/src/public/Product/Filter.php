<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 11:10
 */

namespace Sdk\Product;


class Filter
{
    /**
     * @var string
     */
    private $_categoryCode = null;

    /**
     * @return string
     */
    public function getCategoryCode()
    {
        return $this->_categoryCode;
    }

    /**
     * ProductFilter constructor.
     * @param $categoryCode
     */
    public function __construct($categoryCode)
    {
        $this->_categoryCode = $categoryCode;
    }
}