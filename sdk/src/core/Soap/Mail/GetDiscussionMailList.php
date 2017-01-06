<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 15:24
 */

namespace Sdk\Soap\Mail;


use Sdk\Soap\BaliseTool;

class GetDiscussionMailList extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GetDiscussionMailList';
        parent::__construct();
    }
}