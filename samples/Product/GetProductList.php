<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 20/10/2016
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

$productFilter = new \Sdk\Product\ProductFilter(/* CategoryCode */ '06040201');
$getProductListResponse = $productPoint->getProductList($productFilter);

if ($getProductListResponse->hasError()) {
    echo "Error : " . $getProductListResponse->getErrorMessage();
}
else {

    /**
     * Display all products
     */
    /** @var \Sdk\Product\Product $product */
    foreach ($getProductListResponse->getProductList() as $product) {
        echo "BrandName : " . $product->getBrandName() .
            " - Name : " . $product->getName() .
            " - EAN : " . $product->getEANList() .
            " - SKU : " . $product->getSKU() . "<br/>";
    }

    /**
     * Get product by SKU
     */
    $product = $getProductListResponse->getProductBySku('DOU2009868119440');
    echo "BrandName : " . $product->getBrandName() . " - Name : " . $product->getName() . " - EAN : " . $product->getEANList() . " - SKU : " . $product->getSKU() . "<br/>";


    /**
     * Get products by brand
     */
    $productList = $getProductListResponse->getProductsByBrand('DOUDOU ET COMPAGNIE');
    /** @var \Sdk\Product\Product $product */
    foreach ($productList as $product) {
        echo "BrandName : " . $product->getBrandName() . " - Name : " . $product->getName() . " - EAN : " . $product->getEANList() . " - SKU : " . $product->getSKU() . "<br/>";
    }
}