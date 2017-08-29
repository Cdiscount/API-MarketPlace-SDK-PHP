<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\SubmitFulfilmentActivationRequest;
use \Sdk\Fulfilment\FulfilmentProductDescription;
use \Sdk\Fulfilment\ProductActivationData;
use \Sdk\Fulfilment\FulfilmentProductActionType;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();

$submitFulfilmentActivationRequest = new SubmitFulfilmentActivationRequest();
$productActivationData = new ProductActivationData();

$productActivationData->setAction('Activation');
$productActivationData->setHeight(1);
$productActivationData->setLength(20);
$productActivationData->setProductEAN('AX34567891234');
$productActivationData->setSellerProductReference('ABVG45K');
$productActivationData->setWeight(50);
$productActivationData->setWidth(10);

$submitFulfilmentActivationRequest->addProductActivationData($productActivationData);

/*
* @param $response \Sdk\Soap\Fulfilment\Response\SubmitFulfilmentActivationResponse
*/
$response = $fulfilmentPoint->SubmitFulfilmentActivation($submitFulfilmentActivationRequest);
//$response->generateDepositIdResult();

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
    if($response->getSubmitFulfilmentActivationResult()->getDepositId() != null)
    {
        /*
        * @return long
        */
        echo "DepositId :" . $response->getSubmitFulfilmentActivationResult()->getDepositId();
    }
    
}

