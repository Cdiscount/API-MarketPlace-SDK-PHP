 <?php

/**
 * Description of GetProductStockList
 * @Mail Abdelahdi.oubaid@ext.cdiscount.com
 * @author Abdelhadi Oubaid
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\FulfilmentProductRequest;
use \Sdk\Soap\Fulfilment\Response\GetProductStockListResponse;

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
$fulfilmentPoint = $client->getFulfilmentPoint();
$fulfilmentProductRequest = new FulfilmentProductRequest();
$fulfilmentProductRequest->addBarCodeList("9421018217166");
$fulfilmentProductRequest->setFulfilmentReferencement("All");

/**
 * Call the GetProductStockList method
 */
$response = $fulfilmentPoint->GetProductStockList($fulfilmentProductRequest);
if ($response->hasError()) {
    echo "Error : " . $response->getErrorMessage();
    die;
}
   
else {
     /*
     * @var \Sdk\Fulfilment\productStock
     */
        if($response->getErrorMessage() != null)
        {
            echo "Message d'erreur : Error " . $response->getErrorMessage();
        }
        else
        {
            /** @var \Sdk\Fulfilment\productStock $productStock */
            foreach ($response->getProductStockList() as $productStock)
            {
                echo "BlockedStock :". $productStock->getBlockedStock() . "<br/><br/>";
                echo "Ean :" . $productStock->getEan() . "<br/><br/>";
                echo "FodStock :" . $productStock->getFodStock() . "<br/><br/>";
                echo "FrontStock :" . $productStock->getFrontStock() . "<br/><br/>";
                echo "IsReferenced :" . $productStock->getIsReferenced() . "<br/><br/>";
                echo "Libelle :" . $productStock->getLibelle() . "<br/><br/>";
                echo "SellerReference :" . $productStock->getSellerReference() . "<br/><br/>";
                echo "Sku :" . $productStock->getSku() . "<br/><br/>";
                echo "StockInWarehouse :" . $productStock->getStockInWarehouse() . "<br/><br/>";
                echo "Warehouse :" . $productStock->getWarehouse() . "<br/><br/>";
            }
        }
            echo "Status : " . $response->getStatus() . "<br/><br/>";
            echo "Total Product Count : " . $response->getTotalProductCount() . "<br/><br/>";
    }
