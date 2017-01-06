<?php
/**
 * Created by Cdiscount.
 * Date: 01/12/2016
 * Time: 15:46
 */

namespace Sdk\Soap\Order;


use Sdk\Soap\BaliseTool;

class GetGlobalConfiguration extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetGlobalConfiguration';
        parent::__construct();
    }
}