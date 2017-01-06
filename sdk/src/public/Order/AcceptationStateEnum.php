<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/10/2016
 * Time: 10:24
 */

namespace Sdk\Order;


class AcceptationStateEnum
{
    const AcceptedBySeller = 'AcceptedBySeller';
    const RefusedBySeller = 'RefusedBySeller';
    const ShippedBySeller = 'ShippedBySeller';
    const ShipmentRefusedBySeller = 'ShipmentRefusedBySeller';
    const CancelledBeforeNotificationByCustomer = 'CancelledBeforeNotificationByCustomer';
    const CancelledBeforePaymentByCustomer = 'CancelledBeforePaymentByCustomer';
    const CancellationRequestPending = 'CancellationRequestPending';

}