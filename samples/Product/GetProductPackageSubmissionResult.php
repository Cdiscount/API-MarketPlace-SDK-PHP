<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 16:18
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


/*******************  GET PRODUCT PACKAGE SUBMISSION RESULT  *******************/

$productPoint = $client->getProductPoint();

$getProductPackageSubmissionResultResponse = $productPoint->getProductPackageSubmissionResult(/* Package ID */264655);

if ($getProductPackageSubmissionResultResponse->hasError()) {
    echo $getProductPackageSubmissionResultResponse->getErrorMessage();
    die;
}

if ($getProductPackageSubmissionResultResponse->isPackageImportHasErrors()) {
    /** @var Sdk\Product\ProductReportLog $reportLog */
    foreach ($getProductPackageSubmissionResultResponse->getProductLogList() as $reportLog) {

        echo "------------------------------------------------<br/>";

        echo "LogDate : " . $reportLog->getLogDate() . "<br/>";
        echo "ProductIntegrationStatus : " . $reportLog->getProductIntegrationStatus() . "<br/>";
        echo "SKU : " . $reportLog->getSKU() . "<br/>";
        echo "Validated : " . ($reportLog->isValidated() ? 'true' : 'false') . "<br/>";

        /** @var \Sdk\Product\ProductReportPropertyLog $productReportPropertyLog */
        foreach ($reportLog->getPropertyList() as $productReportPropertyLog) {
            echo "-- ProductReportPropertyLog - ErrorCode : " . $productReportPropertyLog->getErrorCode() . "<br/>";
            echo "-- ProductReportPropertyLog - LogMessage : " . $productReportPropertyLog->getLogMessage() . "<br/>";
            echo "-- ProductReportPropertyLog - Name : " . ($productReportPropertyLog->getName() == null ? 'null' : $productReportPropertyLog->getName()) . "<br/>";
            echo "-- ProductReportPropertyLog - PropertyError : " . $productReportPropertyLog->getPropertyError() . "<br/>";
        }
        echo "<br/><br/>";
    }
}
else {
    echo "------------------------------------------------<br/>";

    echo "PackageId : " . $getProductPackageSubmissionResultResponse->getPackageId() . "<br/>";
    echo "PackageIntegrationStatus : " . $getProductPackageSubmissionResultResponse->getPackageIntegrationStatus() . "<br/>";
}
