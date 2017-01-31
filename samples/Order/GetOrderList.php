<?php
/**
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 14:07
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

/**
 *
 * ORDER EXAMPLE
 *
 */


/******    GET ORDER LIST    *******/

$orderPoint = $client->getOrderPoint();

$orderFilter = new \Sdk\Order\OrderFilter();
$orderFilter->setBeginCreationDate('2016-10-20T00:00:00.00');
$orderFilter->setBeginModificationDate('2016-10-20T01:00:00.00');
$orderFilter->setEndCreationDate('2016-10-30T23:59:59.99');
$orderFilter->setEndModificationDate('2016-10-30T02:00:00.00');
$orderFilter->setFetchOrderLines(true);

$orderFilter->addState(\Sdk\Order\OrderStateEnum::CancelledByCustomer);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::WaitingForSellerAcceptation);
/*$orderFilter->addState(\Sdk\Order\OrderStateEnum::AcceptedBySeller);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::PaymentInProgress);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::WaitingForShipmentAcceptation);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::Shipped);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::RefusedBySeller);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::AutomaticCancellation);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::PaymentRefused);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::ShipmentRefusedBySeller);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::RefusedNoShipment);*/

$orderListResponse = $orderPoint->getOrderList($orderFilter);
//echo $orderListResponse->getTokenID();

if ($orderListResponse->hasError()) {
    echo $orderListResponse->getErrorMessage();
    die;
}

$orders = $orderListResponse->getOrderList()->getOrders();

if ($orders == null) {
    echo "You have no order matching these dates<br/>";
    die;
}

/** @var \Sdk\Order\Order $order */
foreach ($orders as $order) {

    echo "<br/><br/>";

    echo "---------      ORDER     ----------<br/>";

    echo "Order Number : " . $order->getOrderNumber() . "<br/>";
    echo "Visa : " . $order->getVisaCegid() . "<br/>";
    echo "ShippingCity : " . $order->getShippingAddress()->getCity() . "<br/>";
    echo "OrderState : " . $order->getOrderState() . "<br/>";

    echo "ArchiveParcelList : " . $order->isArchiveParcelList() . "<br/>";

    echo "---------      ORDER END     ----------<br/>";

    $parceList = $order->getParcelList()->getParcels();

    /** @var \Sdk\Parcel\Parcel $parcel */
    foreach ($parceList as $parcel) {
        echo "---------      PARCEL     ----------<br/>";

        echo "Customer Number : " . $parcel->getCustomerNum() . "<br/>";
        echo "Parcel Status : " . $parcel->getParcelStatus() . "<br/>";

        echo "---------      PARCEL ITEM    ----------<br/>";

        $parcelItemList = $parcel->getParcelItemList()->getParcelItems();
        /** @var \Sdk\Parcel\ParcelItem $parcelItem */
        foreach ($parcelItemList as $parcelItem) {
            echo "ProductName : " . $parcelItem->getProductName() . "<br/>";
            echo "Quantity : " . $parcelItem->getQuantity() . "<br/>";
            echo "Sku : " . $parcelItem->getSku() . "<br/>";
        }

        echo "---------      END PARCEL ITEM    ----------<br/>";

        echo "---------      END PARCEL     ----------<br/>";
    }

    echo "---------      ORDERLINELIST     ----------<br/>";

    $orderLineList = $order->getOrderLineList()->getOrderLines();
    foreach ($orderLineList as $orderLine) {

        echo "AcceptationState = " . $orderLine->getAcceptationState() . "<br/>";
        echo "CategoryCode = " . $orderLine->getCategoryCode() . "<br/>";
        echo "DeliveryDateMax = " . $orderLine->getDeliveryDateMax() . "<br/>";
        echo "DeliveryDateMin = " . $orderLine->getDeliveryDateMin() . "<br/>";
        echo "HasClaim = " . $orderLine->isHasClaim() . "<br/>";
        echo "InitialPrice = " . $orderLine->getInitialPrice() . "<br/>";
        echo "IsCDAV = " . $orderLine->isCdav() . "<br/>";
        echo "IsNegotiated = " . $orderLine->isIsNegotiated() . "<br/>";
        echo "IsProductEanGenerated = " . $orderLine->isProductEanGenerated() . "<br/>";
        echo "Name = " . $orderLine->getName() . "<br/>";
        echo "ProductCondition = " . $orderLine->getProductCondition() . "<br/>";
        echo "ProductEan = " . $orderLine->getProductEan() . "<br/>";
        echo "ProductId = " . $orderLine->getProductId() . "<br/>";
        echo "PurchasePrice = " . $orderLine->getPurchasePrice() . "<br/>";
        echo "Quantity = " . $orderLine->getQuantity() . "<br/>";
        echo "RowId = " . $orderLine->getRowId() . "<br/>";
        echo "SellerProductId = " . $orderLine->getSellerProductId() . "<br/>";
        echo "ShippingDateMax = " . $orderLine->getShippingDateMax() . "<br/>";
        echo "ShippingDateMin = " . $orderLine->getShippingDateMin() . "<br/>";
        echo "Sku = " . $orderLine->getSku() . "<br/>";
        echo "SkuParent = " . $orderLine->getSkuParent() . "<br/>";
        echo "UnitAdditionalShippingCharges = " . $orderLine->getUnitAdditionalShippingCharges() . "<br/>";
        echo "UnitShippingCharges = " . $orderLine->getUnitShippingCharges() . "<br/>";
    }

    echo "---------      ORDERLINELISTEND     ----------<br/>";
}