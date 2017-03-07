<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 15/11/2016
 * Time: 16:14
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

/************************** GET PRODUCT PACKAGE MATCHING FILE DATA ***************************/

$productPoint = $client->getProductPoint();

$getProductPackageProductMatchingFileDataResponse = $productPoint->getProductPackageProductMatchingFileData(/* Package ID */264650);

if ($getProductPackageProductMatchingFileDataResponse->hasError()) {
    foreach ($getProductPackageProductMatchingFileDataResponse->getErrorList() as $error) {
        echo $error . "<br/>";
    }
    die;
}

echo "SellerLogin::" . $getProductPackageProductMatchingFileDataResponse->getSellerLogin() . "<br/>";
echo "TokenId::" . $getProductPackageProductMatchingFileDataResponse->getTokenID() . "<br/>";
echo "PackageId::" . $getProductPackageProductMatchingFileDataResponse->getPackageId() . "<br/>";

if ($getProductPackageProductMatchingFileDataResponse->getProductMatchingList() != null) {
    /** @var \Sdk\Product\ProductMatching $productmatching */
    foreach ($getProductPackageProductMatchingFileDataResponse->getProductMatchingList() as $productmatching) {
        echo "Color : " . $productmatching->getColor() . "<br/>";
        echo "Comment : " . $productmatching->getComment() . "<br/>";
        echo "Ean : " . $productmatching->getEan() . "<br/>";
        echo "MatchingStatus : " . $productmatching->getMatchingStatus() . "<br/>";
        echo "Name : " . $productmatching->getName() . "<br/>";
        echo "SellerProductId : " . $productmatching->getSellerProductId() . "<br/>";
        echo "Size : " . $productmatching->getSize() . "<br/>";
        echo "Sku : " . $productmatching->getSKU() . "<br/>";
    }
}
