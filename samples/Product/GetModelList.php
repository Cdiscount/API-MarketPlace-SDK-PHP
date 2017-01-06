<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 11:29
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


/******* GET MODEL LIST *******/

$modelFilter = new \Sdk\Product\ModelFilter(/* CategoryCode */ '06040201');

$productPoint = $client->getProductPoint();

$getModelListResponse = $productPoint->getModelList($modelFilter);

/** @var \Sdk\Product\ProductModel $productModel */
foreach ($getModelListResponse->getModelList() as $productModel) {

    echo "<br/>CategoryCode : " . $productModel->getCategoryCode() . "<br/>";
    echo "ModelId : " . $productModel->getModelId() . "<br/>";
    echo "Name : " . $productModel->getName() . "<br/>";
    echo "Struct XML : " . $productModel->getProductXmlStructure() . "<br/>";

    // @var \Sdk\Product\KeyValueProperty $property
    foreach ($productModel->getValueProperties() as $property) {
        echo "Key : " . $property->getKey() . "<br/>";

        foreach ($property->getValues() as $value) {
            echo " -- value : " . $value . "<br/>";
        }
    }

}
