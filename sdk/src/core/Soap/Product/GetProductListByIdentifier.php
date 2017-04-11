<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 19/10/2016
 * Time: 11:11
 */

namespace Sdk\Soap\Product;

use Sdk\Soap\BaliseTool;

/**
 * Get product list by identifier
 */
class GetProductListByIdentifier extends BaliseTool
{
    /**
     * GetProductListByIdentifier constructor.
     * @param $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetProductListByIdentifier';
        parent::__construct();
    }
}