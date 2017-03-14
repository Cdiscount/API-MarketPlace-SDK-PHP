<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
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
/*$orderFilter->setBeginCreationDate('2016-12-01T00:00:00.00');
$orderFilter->setBeginModificationDate('2016-12-01T01:00:00.00');
$orderFilter->setEndCreationDate('2017-01-30T23:59:59.99');
$orderFilter->setEndModificationDate('2017-01-30T02:00:00.00');*/
$orderFilter->setFetchOrderLines(false);
/*
$orderFilter->addState(\Sdk\Order\OrderStateEnum::CancelledByCustomer);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::WaitingForSellerAcceptation);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::AcceptedBySeller);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::PaymentInProgress);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::WaitingForShipmentAcceptation);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::Shipped);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::RefusedBySeller);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::AutomaticCancellation);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::PaymentRefused);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::ShipmentRefusedBySeller);
$orderFilter->addState(\Sdk\Order\OrderStateEnum::RefusedNoShipment);*/
$orderFilter->setFetchParcels(false);
//$orderFilter->addOrderReferenceToList('1604248913ZDAAD');
//$orderFilter->setOrderType(\Sdk\Order\OrderTypeEnum::EXTFBC);
//$orderFilter->setPartnerOrderRef('ENA_test_APIFBC_20161117_03');

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

    echo "&nbsp;&nbsp;&nbsp;ArchiveParcelList : " . ($order->isArchiveParcelList() ? 'true' : 'false') . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;CreationDate : " . $order->getCreationDate() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;HasClaims : " . ($order->isHasClaims() ? 'true' : 'false') . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;InitialTotalAmount : " . $order->getInitialTotalAmount() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;InitialTotalShippingChargesAmount : " . $order->getInitialTotalShippingChargesAmount() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;isCLogistiqueOrder : " . ($order->isIsCLogistiqueOrder() ? 'true' : 'false') . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;LastUpdatedDate : " . $order->getLastUpdatedDate() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;ModGesLog : " . $order->getModGesLog() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;ModifiedDate : " . $order->getModifiedDate() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;Order Number : " . $order->getOrderNumber() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;PartnerOrderRef : " . $order->getPartnerOrderRef() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;ShippedTotalAmount : " . $order->getShippedTotalAmount() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;ShippedTotalShippingCharges : " . $order->getShippedTotalShippingCharges() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;ShippingCode : " . $order->getShippingCode() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;SiteCommissionPromisedAmount : " . $order->getSiteCommissionPromisedAmount() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;SiteCommissionShippedAmount : " . $order->getSiteCommissionShippedAmount() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;SiteCommissionValidatedAmount : " . $order->getSiteCommissionValidatedAmount() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;Status : " . $order->getStatus() . "<br/>";
    echo "&nbsp;&nbsp;&nbsp;Visa : " . $order->getVisaCegid() . "<br/>";

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
        
        echo "---------      Tracking list    ----------<br/>";

        $trackingList = $parcel->getTrackingList();
        if (isset($trackingList)) {
            /*
             * @var \SDK\Parcel\Tracking
             */
            foreach ($trackingList->getTrackings() as $tracking) {
                echo "TrackingId : " . $tracking->getTrackingId() . "<br/>";
                echo "ParcelNum : " . $tracking->getParcelNum() . "<br/>";
                echo "Justification : " . $tracking->getJustification() . "<br/>";
                echo "InsertDate : " . $tracking->getInsertDate() . "<br/>";
            }

            echo "---------      END tracking list   ----------<br/>";

            echo "---------      END PARCEL     ----------<br/>";       
        }
    }
    
    echo "---------      VOUCHER LIST   ----------<br>";
    
    $voucherList = $order->getVoucherList();
    if (isset($voucherList)) {
        /*
         * \Sdk\Order\Voucher
         */
        foreach ($voucherList->getVouchers() as $voucher) {

            echo "Createdate = " . $voucher->getCreateDate() . "<br/>";
            echo "Source = " . $voucher->getSource() . "<br/>";

            echo '<br/>---------REFUND INFORMATION----------------<br/>';

            $refundInformationResponse = $voucher->getRefundInformation();

            echo "Amount = " . $refundInformationResponse->getAmount() . "<br/>";
            echo "Motive id = " . $refundInformationResponse->getMotiveId() . "<br/>";
        }
    }
    echo "---------      END VOUCHER LIST   ----------<br>";
    echo "---------      ORDERLINELIST     ----------<br/>";
    $cntOL = 1;

    if ($order->getOrderLineList() != null) {
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
            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RefundShippingCharges = " . $orderLine->isRefundShippingChargesResult() . "<br/>";
            echo "<br/><br/>";
            ++$cntOL;
        }

    }

    echo "---------      ORDERLINELISTEND     ----------<br/>";
    echo "---------      ORDER END     ----------<br/>";
    ++$cnt;
}