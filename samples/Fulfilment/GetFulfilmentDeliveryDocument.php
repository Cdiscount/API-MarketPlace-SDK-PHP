<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';


use \Sdk\Fulfilment\FulFilmentDeliveryDocumentRequest;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();
$fulfilmentDeliveryDocumentRequest = new FulfilmentDeliveryDocumentRequest('438134','17','364');

/*
* @param $response \Sdk\Soap\Fulfilment\Response\GetFulfilmentDeliveryDocumentResponse
*/
$response = $fulfilmentPoint->GetFulfilmentDeliveryDocument($fulfilmentDeliveryDocumentRequest);

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
     * @return Base64 encoded string
     */

     if($response->getFulfilmentDeliveryDocumentResult()->getPdfDocument() != null)
     {
        echo "PDF Document Base64-Encoded :" . $response->getFulfilmentDeliveryDocumentResult()->getPdfDocument();
     }
}

