<?php

/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 11:58
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

$offerFilter = new \Sdk\Offer\OfferFilter();
$offerFilter->setPageNumber(1);

$offerPoint = $client->getOfferPoint();

$offerListResponse = $offerPoint->getOfferListPaginated($offerFilter);

echo "CurrentPageNumber : " . $offerListResponse->getCurrentPageNumber() . " - NumberOfPages : " . $offerListResponse->getNumberOfPages() . "<br/>";

/** @var \Sdk\Offer\Offer $offer */
foreach ($offerListResponse->getOfferList() as $offer) {
    echo "<br/><br/><br/>---------------------------------------<br/>";
    echo "BestShippingCharges : " . $offer->getBestShippingCharges() . "<br/>";
    echo "Comments : " . ($offer->getComments() == null ? 'empty' : $offer->getComments()). "<br/>";
    echo "CreationDate : " . $offer->getCreationDate() . "<br/>";
    echo "DeaTax : " . $offer->getDeaTax() . "<br/>";
    echo "DiscountList : " . ($offer->getDiscountList() == null ? 'empty' : $offer->getDiscountList()) . "<br/>";
    echo "EcoTax : " . $offer->getEcoTax() . "<br/>";
    echo "IntegrationPrice : " . $offer->getIntegrationPrice() . "<br/>";
    echo "IsCDAV : " . $offer->isIsCDAV() . "<br/>";
    echo "LastUpdateDate : " . $offer->getLastUpdateDate() . "<br/>";
    echo "MinimumPriceForPriceAlignment : " . $offer->getMinimumPriceForPriceAlignment() . "<br/>";

    /** @var \Sdk\Offer\OfferPool $offerPool */
    foreach ($offer->getOfferPoolList() as $offerPool) {
        echo " -- OfferPool::Description : " . $offerPool->getDescription() . "<br/>";
        echo " -- OfferPool::Id : " . $offerPool->getId() . "<br/>";
    }

    echo "OfferState : " . $offer->getOfferState() . "<br/>";
    echo "ParentProductId : " . $offer->getParentProductId() . "<br/>";

    echo "Price : " . $offer->getPrice() . "<br/>";
    echo "PriceMustBeAligned : " . $offer->getPriceMustBeAligned() . "<br/>";
    echo "ProductCondition : " . $offer->getProductCondition() . "<br/>";
    echo "ProductEan : " . $offer->getProductEan() . "<br/>";
    echo "ProductId : " . $offer->getProductId() . "<br/>";
    echo "ProductPackagingUnit : " . $offer->getProductPackagingUnit() . "<br/>";
    echo "ProductPackagingUnitPrice : " . $offer->getProductPackagingUnitPrice() . "<br/>";
    echo "ProductPackagingValue : " . $offer->getProductPackagingValue() . "<br/>";
    echo "SellerProductId : " . $offer->getSellerProductId() . "<br/>";

    if ($offer->getShippingInformationList() != null) {
        /** @var \Sdk\Delivey\ShippingInformation $shippingInformation */
        foreach ($offer->getShippingInformationList() as $shippingInformation) {
            echo " -- ShippingInformation::AdditionalShippingCharges : " . $shippingInformation->getAdditionalShippingCharges() . "<br/>";
            echo " ---- ShippingInformation::DeliveryMode::Code : " . $shippingInformation->getDeliveryMode()->getCode() . "<br/>";
            echo " ---- ShippingInformation::DeliveryMode::Name : " . $shippingInformation->getDeliveryMode()->getName() . "<br/>";
            echo " -- ShippingInformation::MaxLeadTime : " . $shippingInformation->getMaxLeadTime() . "<br/>";
            echo " -- ShippingInformation::MinLeadTime : " . $shippingInformation->getMinLeadTime() . "<br/>";
            echo " -- ShippingInformation::ShippingCharges : " . $shippingInformation->getShippingCharges() . "<br/>";
        }
    }

    echo "Stock : " . $offer->getStock() . "<br/>";
    echo "StrikedPrice : " . $offer->getStrikedPrice() . "<br/>";
    echo "VatRate : " . $offer->getVatRate() . "<br/>";
}