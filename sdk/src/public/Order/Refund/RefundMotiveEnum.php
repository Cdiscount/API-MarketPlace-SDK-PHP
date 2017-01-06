<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 15:38
 */

namespace Sdk\Order\Refund;


abstract class RefundMotiveEnum
{
    const ClientClaim  = 'ClientClaim';
    const VendorInitiatedRefund  = 'VendorInitiatedRefund';
    const ClientRetraction = 'ClientRetraction';
}