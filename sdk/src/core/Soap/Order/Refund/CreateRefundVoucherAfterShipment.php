<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 16:28
 */

namespace Sdk\Soap\Order\Refund;


use Sdk\Soap\BaliseTool;

class CreateRefundVoucherAfterShipment extends BaliseTool
{

    public function __construct()
    {
        $this->_tag = 'CreateRefundVoucherAfterShipment';

        parent::__construct();
    }

}