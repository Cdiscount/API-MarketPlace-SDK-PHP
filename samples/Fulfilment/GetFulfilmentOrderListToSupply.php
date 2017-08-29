<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 20/10/2016
 * Time: 14:43
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


$fulfilmentPoint = $client->getFulfilmentPoint();

$fulfilmentOnDemandOrderLineRequest = new \Sdk\Fulfilment\FulfilmentOnDemandOrderLineFilter('1704261314FH6QI','3515060974125','ANZ');
$getFulfilmentOrderListToSupplyResponse = $fulfilmentPoint->GetFulfilmentOrderListToSupply($fulfilmentOnDemandOrderLineRequest);

if ($getFulfilmentOrderListToSupplyResponse->getOperationSuccess() == false) {
    if( $getFulfilmentOrderListToSupplyResponse->getErrorMessage() != null ){
        echo 'Error : ' . $getFulfilmentOrderListToSupplyResponse->getErrorMessage();
    } else if( $getFulfilmentOrderListToSupplyResponse->getErrorList() != null ) {
        echo "Error List : <br/>";
        foreach ($getFulfilmentOrderListToSupplyResponse->getErrorList() as $error){
            echo $error . '<br/>';
        }
    }
    die;
}
else {

    /**
     * Display all products
     */
    /** @var \Sdk\Fulfilment\FulfilmentOrderLine $fulfilmentOrderLine */
    foreach ($getFulfilmentOrderListToSupplyResponse->getFulfilmentOrderListToSupplyResult()->getFulfilmentOrderLineList() as $fulfilmentOrderLine)
    {
        echo "<br/>";
        echo " - Product Ean : " . $fulfilmentOrderLine->getProductEan() . "<br/>";
        echo " - Name : " . $fulfilmentOrderLine->getProductName() . "<br/>";
        echo " - OrderReference : " . $fulfilmentOrderLine->getOrderReference() . "<br/>";
        echo " - SellerProductReference : " . $fulfilmentOrderLine->getSellerProductReference() . "<br/>";
        echo " - LatestWarehouseDeliveryDate : " . $fulfilmentOrderLine->getLatestWarehouseDeliveryDate() . "<br/>";
        echo " - OrderDate : " . $fulfilmentOrderLine->getOrderDate() . "<br/>";
        echo " - ExpectedCustomerDeliveryMin : " . $fulfilmentOrderLine->getExpectedCustomerDeliveryMin() . "<br/>";
        echo " - Warehouse : " . $fulfilmentOrderLine->getWarehouse() . "<br/>";
    }    
}