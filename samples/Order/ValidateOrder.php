<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
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

$order = new \Sdk\Order\Validate\ValidateOrder('161018202610YWR');
//$order->setCarrierName('CarrierName');
$order->setOrderState(\Sdk\Order\OrderStateEnum::ShipmentRefusedBySeller);
//$order->setTrackingNumber("TrackingNumber");
//$order->setTrackingUrl("TrackingUrl");

$orderLineList = new \Sdk\Order\OrderLineList();

/**
 * AcceptationState : AcceptedBySeller
 * ProductCondition : New
 * SellerProductId : CHI8003970895435
 */

$validateOrderLine = new \Sdk\Order\Validate\ValidateOrderLine('wz-4013594589482', \Sdk\Order\OrderStateEnum::ShipmentRefusedBySeller, \Sdk\Order\ProductConditionEnum::NewS);
//$validateOrderLine->setTypeOfReturn(\Sdk\Order\AskingForReturnType::AskingForReturn);

$orderLineList->addOrderLine($validateOrderLine);
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

    if(isset($validateOrderResults)){
        /** @var \Sdk\Order\Validate\ValidateOrderResult $validateOrder */
        foreach ($validateOrderResults->getValidateOrderResultList() as $validateOrder) {
        echo "OrderNumber : " . $validateOrder->getOrderNumber() . "<br/>";
            if(isset($validateOrder)){
                /** @var \Sdk\Order\Validate\ValidateOrderLineResult $validateOrderLineResult */
                foreach ($validateOrder->getValidateOrderLineResults()->getValidateOrderLineResultList() as $validateOrderLineResult) {
                    echo " SellerProductID : " . $validateOrderLineResult->getSellerProductId() . "<br/>";
                    echo " Product Updated : " . $validateOrderLineResult->isUpdated() . "<br/>";
                }
            }      
        }
    }  
}