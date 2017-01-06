<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 17/10/2016
 * Time: 13:11
 */

namespace Sdk\Order\Validate;

use Sdk\Order\OrderLine;

class ValidateOrderLine extends OrderLine
{

    public function __construct($sellerProductId, $acceptationState, $productCondition)
    {
        parent::setSellerProductId($sellerProductId);
        parent::setProductCondition($productCondition);
        parent::setAcceptationState($acceptationState);
        parent::__construct(0);
    }
}