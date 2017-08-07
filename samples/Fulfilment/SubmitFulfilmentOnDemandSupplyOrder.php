<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\FulfilmentOnDemandSupplyOrderRequest;
use \Sdk\Fulfilment\FulfilmentOrderLineRequest;
use Sdk\Soap\Fulfilment\SubmitFulfilmentOnDemandSupplyOrderSoap;
error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) 
{
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();

$fulfilmentOnDemandSupplyOrderRequest = new FulfilmentOnDemandSupplyOrderRequest();
$fulfilmentOrderLineRequest = new FulfilmentOrderLineRequest('1703182124BNXCO', '2009854780777');
$fulfilmentOnDemandSupplyOrderRequest->addOrderLineList($fulfilmentOrderLineRequest);

$response = $fulfilmentPoint->SubmitFulfilmentOnDemandSupplyOrder($fulfilmentOnDemandSupplyOrderRequest);

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
} else 
{
    
    /*
     * @return long
     */
   echo "DepositId :" . $response->getSubmitFulfilmentOnDemandSupplyOrderResult()->getDepositId();

}

    
