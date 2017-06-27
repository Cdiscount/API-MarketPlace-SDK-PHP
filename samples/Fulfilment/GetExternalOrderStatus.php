 <?php

/**
 * Description of GetExternalOrderStatus
 * @Mail Abdelahdi.oubaid@ext.cdiscount.com
 * @author Abdelhadi Oubaid
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\OrderStatusRequest;
use \Sdk\Soap\Fulfillment\Response\GetExternalOrderStatusResponse;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Erreur lors de la generation du token, 
    veuillez verifier vos identifiants dans le fichier de configuration.";
    die;
}

/**
 * Get the Fulfillment Point
 */
$fulfillmentPoint = $client->getFulfilmentPoint();
$orderStatusRequest = new OrderStatusRequest(); 
$orderStatusRequest-> setCorporation("FNAC");
$orderStatusRequest->setCustomerOrderNumber("test_09_05_1lmsdlffezd");

/**
 * Call the GetExternalOrderStatus method
 */
$response = $fulfillmentPoint->GetExternalOrderStatus($orderStatusRequest);

if( $response->getErrorMessage() != null )
{
	echo "Message d'erreur : Error " . $response->getErrorMessage();
	die;
} 
else
{    
  echo "Status :" . $response->getStatus();
}
