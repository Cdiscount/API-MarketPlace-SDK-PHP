<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/11/2016
 * Time: 16:17
 */

namespace Sdk\Soap\Mail;


use Sdk\Soap\BaliseTool;

class GenerateDiscussionMailGuid extends BaliseTool
{
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'GenerateDiscussionMailGuid';
        parent::__construct();
    }
}