<?php
/**
 * Created by Sara.Hannouti.
 * Mail: sara.hannouti@ext.cdiscount.com
 * Date: 23/03/2017
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


$productPoint = $client->getProductPoint();

$identifierRequest = new \Sdk\Product\IdentifierRequest();
$identifierRequest->setIdentifierType(\Sdk\Product\IdentifierTypeEnum::EAN);
$identifierRequest->addValue("8007842890358");
$identifierRequest->addValue("0889842015317");
$identifierRequest->addValue("8710103721024");
$identifierRequest->addValue("4250525314960");
$identifierRequest->addValue("7426775682402");
$identifierRequest->addValue("7426775682419");
$identifierRequest->addValue("2009926710664");
$identifierRequest->addValue("3606507422191");
$identifierRequest->addValue("0000906090532");
$identifierRequest->addValue("3760207010673");
/*$identifierRequest->addValue("3612407191563");
$identifierRequest->addValue("3612405542879");
$identifierRequest->addValue("6565658392821");
$identifierRequest->addValue("0264747482929");
$identifierRequest->addValue("1200000045479");
$identifierRequest->addValue("3606508573212");
$identifierRequest->addValue("3606508827551");
$identifierRequest->addValue("5030946113774");
$identifierRequest->addValue("0889842121674");
$identifierRequest->addValue("3606508160177");
$identifierRequest->addValue("9782211057301");
$identifierRequest->addValue("3700099516013");
$identifierRequest->addValue("2009899290279");
$identifierRequest->addValue("2900001112321");
$identifierRequest->addValue("3425160157604");
$identifierRequest->addValue("2009822441327");
$identifierRequest->addValue("8718475884026");
$identifierRequest->addValue("4004218151536");*/


$getProductListByIdentifierResponse = $productPoint->getProductListByIdentifier($identifierRequest);

if ($getProductListByIdentifierResponse->hasError()) {
    echo "Error : " . $getProductListByIdentifierResponse->getErrorMessage();
}
else {

    $i = 1;
    foreach ($getProductListByIdentifierResponse->getProductList() as $product) {
        echo "Product " . $i . ": <Br/>";                
        if($product->getHasError() == 'true')
        {
            echo "Message d'erreur : " . $product->getErrorMessage();
        }
        else
        {
            echo  "EAN  : " . $product->getEAN() .
                    ", Marque  : " . $product->getBrandName() .
                    ", Catégorie  : " . $product->getCategoryCode() .
                    ", Nom  : " . $product->getName() .
                    ", SKU(parent)  : " . $product->getFatherProductId() .
                    ", URL image  : " . $product->getImageURL()  .                    
                    ", Type produit  : " . $product->getProductType() .
                    ", Couleur  : " . $product->getColor() .                    
                    ", Taille  : " . $product->getSize() ;
        }

        echo "<br/>";
        $i = $i + 1;
    }
}