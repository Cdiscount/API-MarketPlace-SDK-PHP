<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 11/10/2016
 * Time: 10:03
 */

namespace Sdk\Order;


abstract class OrderStateEnum
{
    const CancelledByCustomer = 'CancelledByCustomer';
    const WaitingForSellerAcceptation = 'WaitingForSellerAcceptation';
    const AcceptedBySeller = 'AcceptedBySeller';
    const PaymentInProgress = 'PaymentInProgress';
    const WaitingForShipmentAcceptation = 'WaitingForShipmentAcceptation';
    const Shipped = 'Shipped';
    const RefusedBySeller = 'RefusedBySeller';
    const AutomaticCancellation = 'AutomaticCancellation';
    const PaymentRefused = 'PaymentRefused';
    const ShipmentRefusedBySeller = 'ShipmentRefusedBySeller';
    const None = 'None';
    const ValidatedFianet = 'ValidatedFianet';
    const RefusedNoShipment = 'RefusedNoShipment';
    const AvailableOnStore = 'AvailableOnStore';
    const NonPickedUpByCustomer = 'NonPickedUpByCustomer';
    const PickedUp = 'PickedUp';
    const ShippedBySeller = 'ShippedBySeller';
}