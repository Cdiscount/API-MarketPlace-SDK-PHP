<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 14:35
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

/*****    VALIDATE ORDER   *****/

//DO NOT USE VALIDATE ORDER -> still in dev

/**
 * OrderNumber : 1109029051W54OU
 * OrderState : AcceptedBySeller
 * TrackingNumber : TrackingNumber
 * TrackingUrl : TrackingNumber
 * CarrierName : CarrierName
 */

$orderPoint = $client->getOrderPoint();

$order = new \Sdk\Order\Validate\ValidateOrder('16101110561AWIN');
$order->setCarrierName('CarrierName');
$order->setOrderState(\Sdk\Order\OrderStateEnum::ValidatedFianet);
$order->setTrackingNumber("TrackingNumber");
$order->setTrackingUrl("TrackingUrl");


$orderLineList = new \Sdk\Order\OrderLineList();

/**
 * AcceptationState : AcceptedBySeller
 * ProductCondition : New
 * SellerProductId : CHI8003970895435
 */

$orderLineList->addOrderLine(new \Sdk\Order\Validate\ValidateOrderLine('2926746', \Sdk\Order\OrderStateEnum::AcceptedBySeller, \Sdk\Order\ProductConditionEnum::NewS));
//$orderLineList->addOrderLine(new \Sdk\Order\ValidateOrderLine('DOD3592668078117', \Sdk\Order\OrderStateEnum::AcceptedBySeller, \Sdk\Order\ProductConditionEnum::NewS));

$order->setOrderLineList($orderLineList);

$orderList = new \Sdk\Order\OrderList();
$orderList->addOrder($order);

$validateOrderListResponse = $orderPoint->validateOrderList($orderList);

if ($validateOrderListResponse->hasError()) {
    echo $validateOrderListResponse->getErrorMessage();
}
else {

    $validateOrderResults = $validateOrderListResponse->getValidateOrderResults();

    /** @var \Sdk\Order\Validate\ValidateOrderResult $validateOrder */
    foreach ($validateOrderResults->getValidateOrderResultList() as $validateOrder) {
        echo " OrderNumber : " . $validateOrder->getOrderNumber() . "<br/>";

        /** @var \Sdk\Order\Validate\ValidateOrderLineResult $validateOrderLineResult */
        foreach ($validateOrder->getValidateOrderLineResults()->getValidateOrderLineResults() as $validateOrderLineResult) {
            echo " SellerProductID : " . $validateOrderLineResult->getSellerProductId() . "<br/>";
            echo " Product Updated : " . $validateOrderLineResult->isUpdated() . "<br/>";
        }

    }

}