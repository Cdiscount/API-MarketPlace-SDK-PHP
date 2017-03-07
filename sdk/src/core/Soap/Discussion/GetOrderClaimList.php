<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 10:35
 */

namespace Sdk\Soap\Discussion;


use Sdk\Soap\BaliseTool;

class GetOrderClaimList extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetOrderClaimList';
        parent::__construct();
    }

    /**
     * Add a namespace
     *
     * @param $namespace
     */
    public function addNamespace($namespace)
    {
        $this->_xmlns .= " " . $namespace;
    }
}