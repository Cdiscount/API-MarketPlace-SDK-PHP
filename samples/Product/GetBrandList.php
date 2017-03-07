<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 02/11/2016
 * Time: 10:24
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$productPoint = $client->getProductPoint();

/********** GET BRAND LIST **********/

$brandListMessageResponse = $productPoint->getBrandList();

if ($brandListMessageResponse->hasError()) {
    foreach ($brandListMessageResponse->getErrorList() as $error) {
        echo $error . "<br/>";
    }
}
else {
    foreach ($brandListMessageResponse->getBrandList() as $brand) {
        echo "Brand : " . $brand . "<br/>";
    }
}

