<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\FulfilmentSupplyOrderRequest;
use \Sdk\Fulfilment\FulfilmentProductDescription;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();

$fulfilmentSupplyOrderRequest = new FulfilmentSupplyOrderRequest();
$fulfilmentProductDescription = new FulfilmentProductDescription('155', '1234567891234', '122', '154', '2017-12-12', 'ANZ');
$fulfilmentSupplyOrderRequest->addProductList($fulfilmentProductDescription);

$response = $fulfilmentPoint->SubmitFulfilmentSupplyOrder($fulfilmentSupplyOrderRequest);

if ($response->getOperationSuccess() == false) 
{
    if( $response->getErrorMessage() != null )
    {
        echo 'Error : ' . $response->getErrorMessage();
    } 
    else if( $response->getErrorList() != null )
     {
        echo "Error List : <br/>";
    
        foreach ($response->getErrorList() as $error)
        {
            echo $error . '<br/>';
        }
    }
    die;
} 
else 
{
    /*
     * @return long
     */
     echo "DepositId :" . $response->getSubmitFulfilmentSupplyOrderResult()->getDepositId();
}

