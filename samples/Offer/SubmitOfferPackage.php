<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 08/11/2016
 * Time: 17:38
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

/***********************     SUBMIT OFFER PACKAGE    **********************/

$offerPoint = $client->getOfferPoint();

$submitOfferPackageResponse = $offerPoint->submitOfferPackage("");

echo "PackageId : " . $submitOfferPackageResponse->getPackageId() . "<br/>";

