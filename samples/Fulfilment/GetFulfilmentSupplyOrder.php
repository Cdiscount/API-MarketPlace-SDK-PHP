<?php

/**
 * Description of GetFulfilmentSupplyOrder
 * @author boukhris.zakaria
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\SupplyOrderRequest;

use \Sdk\Fulfilment\SupplyOrder;
use \Sdk\Fulfilment\SupplyOrderList;
error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) 
{
    echo "Oups, souci lors de la génération du token";
    die;
}

/**********  CREATE SUPPLY  ORDER LIST ***********/

$fulfilmentPoint = $client->getFulfilmentPoint();

$supplyOrderRequest = new SupplyOrderRequest();

$supplyOrderRequest->setPageSize(5);
$supplyOrderRequest->setPageNumber(0);
$supplyOrderRequest->addSupplyOrder('FBC_34627');
//$supplyOrderRequest->setBeginModificationDate('2016-01-01');
//$supplyOrderRequest->setEndModificationDate('2017-07-22');

/*
* @return fulfilmentSupplyOrderResponse
*/
$fulfilmentSupplyOrderResponse = $fulfilmentPoint->GetFulfilmentSupplyOrder($supplyOrderRequest);

if ($fulfilmentSupplyOrderResponse->getOperationSuccess() == false) {
    if( $fulfilmentSupplyOrderResponse->getErrorMessage() != null ){
        echo 'Error : ' . $fulfilmentSupplyOrderResponse->getErrorMessage();
    } else if( $fulfilmentSupplyOrderResponse->getErrorList() != null ) {
        echo "Error List : <br/>";
    
        foreach ($fulfilmentSupplyOrderResponse->getErrorList() as $error){
            echo $error . '<br/>';
        }
    }
    die;
} else {
    
    
    echo 'Current Page : ' . $fulfilmentSupplyOrderResponse->getFulfilmentSupplyOrderResult()->getCurrentPageNumber() . '<br/>';

    echo 'Number of pages : ' . $fulfilmentSupplyOrderResponse->getFulfilmentSupplyOrderResult()->getNumberOfPages() . '<br/>';

    echo '<br/><br/> Les elements de Supply Order List sont : <br/><br/>';
    /** @var \Sdk\Fulfilment\SupplyOrder $supplyOrder */
    foreach($fulfilmentSupplyOrderResponse->getFulfilmentSupplyOrderResult()->getSupplyOrderList() as $supplyOrder)
    {
        echo '_____________________________________________' . '<br />';
        
        echo 'SupplyOrderNumber : ' . $supplyOrder->getSupplyOrderNumber() . '<br/>';
        
        echo 'Order reference  List : ' . '<br/>';
        echo '---------------------- ' . '<br/>';

        $orderReferenceList = $supplyOrder->getOrderReferenceList();
        /** @var string $orderReference */
        foreach($orderReferenceList as $orderReference)
        {
            echo 'Order reference  : ' . $orderReference . '<br/>';
        } 
        echo '-----------------------' . '<br/>';
        echo 'IsFod : ' . $supplyOrder->getIsFod() . '<br/>';
        echo 'Status : ' . $supplyOrder->getStatus() . '<br/>';
        echo 'ReceivedQuantity : ' . $supplyOrder->getReceivedQuantity() . '<br/>';
        echo 'SellerProductReference : ' . $supplyOrder->getSellerProductReference() . '<br/>';
        echo 'OrderedQuantity : ' . $supplyOrder->getOrderedQuantity() . '<br/>';   
        echo 'ProductEAN : ' . $supplyOrder->getProductEAN() . '<br/>';       
        echo 'SellerSupplyOrderNumber : ' . $supplyOrder->getSellerSupplyOrderNumber() . '<br/>';
        echo 'UndeliveredQuantity : '.$supplyOrder->getUndeliveredQuantity() . '<br/>';
        echo 'Warehouse : '.$supplyOrder->getWarehouse() . '<br/>';
        echo 'WarehouseReceptionMinDate : '.$supplyOrder->getWarehouseReceptionMinDate() . '<br/>';
        echo '_____________________________________________';
    }
    

}


