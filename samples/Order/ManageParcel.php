<?php
/**
 * Created by Cdiscount.
 * Date: 14/12/2016
 * Time: 15:22
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

/**
 * Create and init the CDSApiClient
 */
$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Erreur lors de la génération du token, veuillez vérifier vos identifiants dans le fichier de configuration.";
    die;
}

/**
 * Get the Order Point
 */
$orderPoint = $client->getOrderPoint();

/**
 * Create a ManageParcelRequest and fill it
 */
$request = new \Sdk\Order\ManageParcelRequest(/* ScopusId */ '161014154004ZYX');
$parcelInfo1 = new \Sdk\Order\ParcelInfos(/* ParcelNumber */ '9V30221426402');
$parcelInfo1->setSku('WIK0683498200192');
$parcelInfo1->setParcelActions('AskingForInvestigation');
$request->addParcelAction($parcelInfo1);

/**
 * Call the manageParcel method
 */
$response = $orderPoint->manageParcel($request);

/**
 * Parse the ManageParcelResponse
 */

if ($response->getOperationSuccess() == false) {
    echo "Error : " . $response->getErrorMessage() . "<br/>";
    die;
}

/** @var \Sdk\Order\ParcelActionResult $actionResult */
foreach ($response->getParcelActionResultList() as $actionResult) {

    if ($actionResult->isOperationSuccess()) {
        echo "ActionType::" . $actionResult->getActionType() . "<br/>";
        echo "ParcelNumber::" . $actionResult->getParcelNumber() . "<br/><br/>";
    }
    else {
        echo $actionResult->getErrorMessage() . "\n";
    }
}