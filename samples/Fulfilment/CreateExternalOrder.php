 <?php

/**
 * Description of CreateExternalOrder
 * @Mail othman.ebaoui@ext.cdiscount.com
 * @author El Ibaoui Otmane
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\OrderIntegrationRequest;
use \Sdk\Soap\Fulfillment\Response\CreateExternalOrderResponse;
use \Sdk\Fulfilment\ExternalOrder;
use \Sdk\Fulfilment\ExternalCustomer;
use \Sdk\Fulfilment\ExternalOrderLine;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Erreur lors de la génération du token, 
    veuillez vérifier vos identifiants dans le fichier de configuration.";
    die;
}

/**
 * Get the Fulfillment Point
 */
$fulfillmentPoint = $client->getFulfilmentPoint();
$orderIntegrationRequest = new OrderIntegrationRequest();
/********************************************************/
$externalOrder = new ExternalOrder();
/********************************************************/
$externalCustomer = new ExternalCustomer();
    $externalCustomer->setCivility("M");
    $externalCustomer->setCustomerFirstName("Polpettini");
    $externalCustomer->setCustomerLastName("Ugo");
    $externalCustomer->setCustomerEmailAddress("agnes.valette@gmail.com");
    $externalCustomer->setShippingAddress("18 rue Paul preboist");
    $externalCustomer->setAdditionalShippingAddress("Rce le Verger d'Hermès");
    $externalCustomer->setLocality("");
    $externalCustomer->setShippingAddressTitle("");
    $externalCustomer->setShippingPostalCode("13013");
    $externalCustomer->setShippingCity("Marseille");
    $externalCustomer->setShippingCountry("FRANCE");
    $externalCustomer->setLandlinePhoneNumber("+33 612 34.56-78");
    $externalCustomer->setCellPhoneNumber("0033.5 123-456 78");
/********************************************************/
$externalOrderLine = new ExternalOrderLine(); 
    $externalOrderLine->setProductEan("9421018217166");
    $externalOrderLine->setProductReference("");
    $externalOrderLine->setQuantity(1);
/********************************************************/
$externalOrder->addExternalOrderLine($externalOrderLine);
$externalOrder->setExternalOrderLine($externalOrderLine);
/********************************************************/
$externalOrder->setExternalCustomer($externalCustomer);
/********************************************************/
$externalOrder->setCustomerOrderNumber("efrze");
$externalOrder->setCorporation("FNAC");
$externalOrder->setComments("");
$externalOrder->setOrderDate("2016-06-08T01:01:01");
$externalOrder->setShippingMode("Domicile standard");
/********************************************************/
$orderIntegrationRequest->setExternalOrder($externalOrder);
/********************************************************/

/**
 * Call the GetProductStockList method
 */
$response = $fulfillmentPoint->CreateExternalOrder($orderIntegrationRequest);
if ($response->hasError()) {
    echo "Error : " . $response->getErrorMessage();
}
else {
        if($response->getErrorMessage() != null)
        {
            echo "Message d'erreur : Error " . $response->getErrorMessage();
        }
        else 
        { 
            if($response->getOperationSuccess() == true)
            {
                echo '<br/>Operation Successful <br/>';
                echo '<br/><br/>API Result : <br/><br/>';
                echo "SellerLogin :". $response->getSellerLogin() . "<br/><br/>";
            }
            else
            {
                echo '<br/>Operation Unsuccessful <br/>';
            }            
        }

    }
