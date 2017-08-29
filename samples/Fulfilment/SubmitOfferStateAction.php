<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\OfferStateActionRequest;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();

$offerStateActionRequest = new OfferStateActionRequest('11504', 'Publish');

/*
* @param $response \Sdk\Soap\Fulfilment\Response\SubmitOfferStateActionResponse
*/
$response = $fulfilmentPoint->SubmitOfferStateAction($offerStateActionRequest);

if ($response->getOperationSuccess() == false) 
{
    echo "Operation sucess : 0".'</br>';
    
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
     * @return bool
     */
     echo "Operation sucess :" . $response->getOperationSuccess().'</br>';
}