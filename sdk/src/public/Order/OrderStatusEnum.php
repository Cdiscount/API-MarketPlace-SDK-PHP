<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/10/2016
 * Time: 09:42
 */

namespace Sdk\Order;


abstract class OrderStatusEnum
{
    const NonValidated = 'NonValidated';
    const NoPaymentAttempt = 'NoPaymentAttempt';
    const Cancelled = 'Cancelled';
    const Validated = 'Validated';
    const Waiting = 'Waiting';
    const Completed = 'Completed';
    const None = 'None';
}