<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 04/11/2016
 * Time: 15:04
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


/************    SUBMIT PRODUCT PACKAGE    ************/

$productPoint = $client->getProductPoint();

$submitProductPackageResponse = $productPoint->submitProductPackage("");

if ($submitProductPackageResponse->hasError()) {
    echo $submitProductPackageResponse->getErrorMessage();
    die;
}

echo "Package ID : " . $submitProductPackageResponse->getPackageId();