<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\FulfilmentActivationReportRequest;
use Sdk\Soap\Fulfilment\GetFulfilmentActivationReportListSoap;
error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) 
{
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();

$depositIdList = array(0);

$fulfilmentActivationReportRequest = new FulfilmentActivationReportRequest('2017-07-01', '2017-07-11',$depositIdList);

/*
* @param $fulfilmentActivationReportRequestXmlResponse Sdk\Soap\Fulfilment\Response\GetFulfilmentActivationReportListResponse
*/
$fulfilmentActivationReportRequestXmlResponse = $fulfilmentPoint->GetFulfilmentActivationReportList($fulfilmentActivationReportRequest);

if ($fulfilmentActivationReportRequestXmlResponse->getOperationSuccess() == false)
{
    if( $fulfilmentActivationReportRequestXmlResponse->getErrorMessage() != null )
    {
        echo 'Error : ' . $fulfilmentActivationReportRequestXmlResponse->getErrorMessage();
    } 
    else if( $fulfilmentActivationReportRequestXmlResponse->getErrorList() != null ) 
    {
        echo "Error List : <br/>";
    
        foreach ($fulfilmentActivationReportRequestXmlResponse->getErrorList() as $error)
        {
            echo $error . '<br/>';
        }
    }
    die;
} 
else 
{
    foreach($fulfilmentActivationReportRequestXmlResponse->getFulfilmentActivationReportListResult()->getFulfilmentActivationReport() as $fulfilmentActivationReport)
    {
        echo 'ReportDate :'.$fulfilmentActivationReport->getReportDate() .'<br/>';
        echo 'DepositId :'.$fulfilmentActivationReport->getDepositId() .'<br/>';
        echo 'NumberOfActivatedProducts :'.$fulfilmentActivationReport->getNumberOfActivatedProducts() .'<br/>';
        echo 'NumberOfDeactivatedProducts :'.$fulfilmentActivationReport->getNumberOfDeactivatedProducts() .'<br/>';
        echo 'NumberOfProcessedProducts :'.$fulfilmentActivationReport->getNumberOfProcessedProducts() .'<br/>';
        echo 'NumberOfProducts :'.$fulfilmentActivationReport->getNumberOfProducts() .'<br/>';
        echo 'NumberOfProductsInError :'.$fulfilmentActivationReport->getNumberOfProductsInError() .'<br/>';
        echo 'NumberOfRemainingProductsToProcess :'.$fulfilmentActivationReport->getNumberOfRemainingProductsToProcess() .'<br/>';
        echo 'DetailsList :'.'<br/>';
        foreach($fulfilmentActivationReport->getFulfilmentActivationReportDetails() as $fulfilmentActivationReportDetails)
        {
            echo 'Action :'.$fulfilmentActivationReportDetails->getAction() .'<br/>';
            echo 'ActionSuccess :'.$fulfilmentActivationReportDetails->getActionSuccess() .'<br/>';
            echo 'Description :'.$fulfilmentActivationReportDetails->getDescription() .'<br/>';
            echo 'ProductEAN :'.$fulfilmentActivationReportDetails->getProductEAN() .'<br/>';
            echo 'SKU :'.$fulfilmentActivationReportDetails->getSKU() .'<br/>';
            echo 'SellerProductReference :'.$fulfilmentActivationReportDetails->getSellerProductReference() .'<br/>';
            echo 'Height :'.$fulfilmentActivationReportDetails->getHeight() .'<br/>';
            echo 'Length :'.$fulfilmentActivationReportDetails->getLength() .'<br/>';
            echo 'Weight :'.$fulfilmentActivationReportDetails->getWeight() .'<br/>';
            echo 'Width :'.$fulfilmentActivationReportDetails->getWidth() .'<br/>';
            echo '______'.'<br/>';
            
        }
        echo '_______________________________________________'.'<br/>';;
    }
}

    
