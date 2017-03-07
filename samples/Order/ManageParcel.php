<?php

/**
 * Description of ManageParcel
 * @Mail mohammed.sajid@ext.cdiscount.com
 * @author mohammed.sajid
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Order\ManageParcelRequest;
use \Sdk\Order\ParcelInfos;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$orderPoint = $client->getOrderPoint();

$manageParcelRequest = new ManageParcelRequest('16101720500TP7I');
$parcelInfos = new ParcelInfos('9V30221431727');
$parcelInfos->setSku('DRT3660050026626');
$parcelInfos->setManageParcel('AskingForDeliveryCertification');
$manageParcelRequest->addParcelActionsList($parcelInfos);

$response = $orderPoint->ManageParcel($manageParcelRequest);

if ($response->getOperationSuccess() == false) {
    if( $response->getErrorMessage() != null ){
        echo 'Error : ' . $response->getErrorMessage();
    } else if( $response->getErrorList() != null ) {
        echo "Error List : <br/>";
    
        foreach ($response->getErrorList() as $error){
            echo $error . '<br/>';
        }
    }
    die;
} else {
    
    echo '<br/><br/>Les élements du parcel action result list : <br/><br/>';
    /*
     * @var \Sdk\Order\ParcelActionResultList
     */
    foreach ($response->getParcelActionResults()->getParcelActionResultList() as $parcelActionResult)
    {
        if ($parcelActionResult->isOperationSuccess() == true)
        {
            echo "OperationSuccess :" . $parcelActionResult->isOperationSuccess() . "<br/>";
            echo "Actiontype :" . $parcelActionResult->getActionType() . "<br/>";
            echo "IsActionCreated :" . $parcelActionResult->isActionCreated() . "<br/>";
            echo "ParcelNumber :" . $parcelActionResult->getParcelNumber() . "<br/><br/>";
        } else {
            echo "ErrorMessage :" . $parcelActionResult->getErrorMessage() . "<br/>";
        }
    }
}
