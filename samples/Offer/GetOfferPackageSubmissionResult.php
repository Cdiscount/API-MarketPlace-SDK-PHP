<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 09/11/2016
 * Time: 11:04
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

/*******************     GET OFFER PACKAGE SUBMISSION RESULT    ****************/

$offerPoint = $client->getOfferPoint();

$getOfferPackageSubmissionResultResponse = $offerPoint->getOfferPackageSubmissionResult(/* Package ID */43015252);

if ($getOfferPackageSubmissionResultResponse->getOfferLogList() == null) {
    echo "No log list<br/>";
    die;
}

/** @var \Sdk\Offer\OfferReportLog $reportLog */
foreach ($getOfferPackageSubmissionResultResponse->getOfferLogList() as $reportLog) {

    echo "LogDate : " . $reportLog->getLogDate() . "<br/>";
    echo "OfferIntegrationStatus : " . $reportLog->getOfferIntegrationStatus() . "<br/>";
    echo "ProductEan : " . $reportLog->getProductEan() . "<br/>";
    echo "SKU : " . $reportLog->getSKU() . "<br/>";
    echo "Validated : " . ($reportLog->isValidated() ? 'true' : 'false') . "<br/>";

    /** @var \Sdk\Offer\OfferReportPropertyLog $offerReportPropertyLog */
    foreach ($reportLog->getPropertyList() as $offerReportPropertyLog) {
        echo "-- OfferReportPropertyLog - ErrorCode : " . $offerReportPropertyLog->getErrorCode() . "<br/>";
        echo "-- OfferReportPropertyLog - LogMessage : " . $offerReportPropertyLog->getLogMessage() . "<br/>";
        echo "-- OfferReportPropertyLog - Name : " . ($offerReportPropertyLog->getName() == null ? 'null' : $offerReportPropertyLog->getName()) . "<br/>";
        echo "-- OfferReportPropertyLog - PropertyError : " . $offerReportPropertyLog->getPropertyError() . "<br/>";
    }
    echo "<br/><br/>";
}

die;