<?php

/**
 * Created by Cdiscount.
 * Date: 01/12/2016
 * Time: 15:46
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

$orderPoint = $client->getOrderPoint();
$getGlobalConfigurationResponse = $orderPoint->getGlobalConfiguration();

/** @var \Sdk\Delivey\Carrier $carrier */
foreach ($getGlobalConfigurationResponse->getCarrierList() as $carrier) {
    echo "--------- Carrier -------------- <br/>";
    echo " -- CarrierId : " . $carrier->getCarrierId() . "<br/>";
    echo " -- DefaultURL : " . $carrier->getDefaultURL() . "<br/>";
    echo " -- Name : " . $carrier->getName() . "<br/>";
}

