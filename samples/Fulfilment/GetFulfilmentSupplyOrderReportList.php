<?php
require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use \Sdk\Fulfilment\SupplyOrderReportRequest;
use Sdk\Soap\Fulfilment\GetFulfilmentSupplyOrderReportListSoap;
error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) 
{
    echo "Oups, souci lors de la génération du token";
    die;
}

$fulfilmentPoint = $client->getFulfilmentPoint();

$depositIdList = array(512615);

$supplyOrderReportRequest = new SupplyOrderReportRequest('2017-05-29', $depositIdList, '2017-06-25', 0, 10);

$fulfilmentSupplyOrderReportListResponse = $fulfilmentPoint->GetFulfilmentSupplyOrderReportList($supplyOrderReportRequest);


if ($fulfilmentSupplyOrderReportListResponse->getOperationSuccess() == false) 
{
    if( $fulfilmentSupplyOrderReportListResponse->getErrorMessage() != null )
    {
        echo 'Error : ' . $fulfilmentSupplyOrderReportListResponse->getErrorMessage();
    } 
    else if( $fulfilmentSupplyOrderReportListResponse->getErrorList() != null )
     {
        echo "Error List : <br/>";
    
        foreach ($fulfilmentSupplyOrderReportListResponse->getErrorList() as $error)
        {
            echo $error . '<br/>';
        }
    }
    die;
}
else 
{
    echo 'Numero de page: '.$fulfilmentSupplyOrderReportListResponse->getFulfilmentSupplyOrderReportListResult()->getCurrentPageNumber().'<br />';
    echo 'Nombre de page: '.$fulfilmentSupplyOrderReportListResponse->getFulfilmentSupplyOrderReportListResult()->getNumberOfPages().'<br />';
    echo '----<br />';
    
    // @var $report SupplyOrderReport \Sdk\Fulfilment\SupplyOrderReport
    foreach($fulfilmentSupplyOrderReportListResponse->getFulfilmentSupplyOrderReportListResult()->getReportList() as $report)
    {
       // @var $result string
       foreach($fulfilmentSupplyOrderReportListResponse->getFulfilmentSupplyOrderReportListResult()->getErrorList() as $result)
       {
            echo $result.'<br />'; 
       }
        echo 'DepositId: '.$report->getDepositId().'<br /><br />';
        foreach($report->getReportLineList() as $reportLine )
        {
            echo 'OrderedQuantity: '.$reportLine->getOrderedQuantity().'<br />';
            echo 'ProductEan: '.$reportLine->getProductEan().'<br />';
            echo 'SellerId: '.$reportLine->getSellerId().'<br />';
            echo 'SellerProductReference: '.$reportLine->getSellerProductReference().'<br />';
            echo 'SellerSupplyOrderNumber: '.$reportLine->getSellerSupplyOrderNumber().'<br />';
            echo 'SupplyOrderNumber: '.$reportLine->getSupplyOrderNumber().'<br />';
            echo 'Warehouse: '.$reportLine->getWarehouse().'<br />';
            echo 'WarehouseReceptionMinDate: '.$reportLine->getWarehouseReceptionMinDate().'<br />';
            echo 'Error Details : ';
            foreach($reportLine->getErrorList() as $error)
            {
                echo $error->getErrorCode().' - ';
                echo $error->getErrorMessage().'<br />';
            }
        }
        echo '-------------------------------------------<br />';
    }
}

    
