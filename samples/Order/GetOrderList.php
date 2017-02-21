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
}

$orders = $orderListResponse->getOrderList()->getOrders();

if ($orders == null) {
    echo "You have no order matching these dates<br/>";
    die;
}

$cnt = 1;

/** @var \Sdk\Order\Order $order */
foreach ($orders as $order) {

    echo "<br/><br/>";

    echo "---------      ORDER n° " . $cnt . " / " . sizeof($orders) . "  ----------<br/>";

    echo "&nbsp;&nbsp;&nbsp;Order Number : " . $order->getOrderNumber() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;Visa : " . $order->getVisaCegid() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;ShippingCity : " . $order->getShippingAddress()->getCity() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;OrderState : " . $order->getOrderState() . "<br/>";

    echo "&nbsp;&nbsp;&nbsp;ArchiveParcelList : " . $order->isArchiveParcelList() . "<br/>";

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

    $cntOL = 1;

    $orderLineList = $order->getOrderLineList()->getOrderLines();
    /** @var Sdk\Order\OrderLine $orderLine */
    foreach ($orderLineList as $orderLine) {

        echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---------      ORDERLINELIST  " . $cntOL . " / " . sizeof($orderLineList) . "    ----------<br/>";

        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AcceptationState = " . $orderLine->getAcceptationState() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CategoryCode = " . $orderLine->getCategoryCode() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DeliveryDateMax = " . $orderLine->getDeliveryDateMax() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DeliveryDateMin = " . $orderLine->getDeliveryDateMin() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HasClaim = " . $orderLine->isHasClaim() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;InitialPrice = " . $orderLine->getInitialPrice() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IsCDAV = " . $orderLine->isCdav() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IsNegotiated = " . $orderLine->isIsNegotiated() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IsProductEanGenerated = " . $orderLine->isProductEanGenerated() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name = " . $orderLine->getName() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ProductCondition = " . $orderLine->getProductCondition() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ProductEan = " . $orderLine->getProductEan() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ProductId = " . $orderLine->getProductId() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PurchasePrice = " . $orderLine->getPurchasePrice() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity = " . $orderLine->getQuantity() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RowId = " . $orderLine->getRowId() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SellerProductId = " . $orderLine->getSellerProductId() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ShippingDateMax = " . $orderLine->getShippingDateMax() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ShippingDateMin = " . $orderLine->getShippingDateMin() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sku = " . $orderLine->getSku() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SkuParent = " . $orderLine->getSkuParent() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UnitAdditionalShippingCharges = " . $orderLine->getUnitAdditionalShippingCharges() . "<br/>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UnitShippingCharges = " . $orderLine->getUnitShippingCharges() . "<br/>";
        echo "<br/><br/>";
        ++$cntOL;
    }

    echo "---------      ORDERLINELISTEND     ----------<br/>";
    echo "---------      ORDER END     ----------<br/>";
    ++$cnt;
}