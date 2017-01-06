<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:08
 */

namespace Sdk\Product;


class ProductFilter extends Filter
{

    /**
     * ProductFilter constructor.
     * @param $categoryCode
     */
    public function __construct($categoryCode)
    {
        parent::__construct($categoryCode);
    }
}