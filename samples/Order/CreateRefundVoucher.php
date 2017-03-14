<?php

/**
 * Description of ManageParcel
 * @Mail mohammed.sajid@ext.cdiscount.com
 * @author mohammed.sajid
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

use Sdk\Order\Refund\CreateRefundVoucherRequest;
use Sdk\Order\Refund\RefundInformation;
use Sdk\Order\Refund\SellerRefundRequest;

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

/**********  CREATE REFUND VOUCHER ***********/

$orderPoint = $client->getOrderPoint();

$createRefundVoucherRequest = new CreateRefundVoucherRequest('161020030119ZJE');
//SellerRefundList
$refundOrderLine = new Sdk\Order\Refund\RefundOrderLine('5053083051983', '5053083051983', true);

$sellerRefundRequest = new SellerRefundRequest($refundOrderLine);

$sellerRefundRequest->setMode(\Sdk\Order\Refund\RefundRequestModeEnum::Claim);
$sellerRefundRequest->setMotive(\Sdk\Order\Refund\RefundMotiveEnum::ClientClaim);

$createRefundVoucherRequest->addSellerRefundRequestToList($sellerRefundRequest);
//CommercialGestureList
$refundInformation = new RefundInformation();
$refundInformation->setAmount(10);
$refundInformation->setMotiveId(133);

$createRefundVoucherRequest->addRefundInformationToList($refundInformation);

$createRefundVoucherResponse = $orderPoint->CreateRefundVoucher($createRefundVoucherRequest);
//
if ($createRefundVoucherResponse->getOperationSuccess() == false) {
    if( $createRefundVoucherResponse->getErrorMessage() != null ){
        echo 'Error : ' . $createRefundVoucherResponse->getErrorMessage();
    } else if( $createRefundVoucherResponse->getErrorList() != null ) {
        echo "Error List : <br/>";
    
        foreach ($createRefundVoucherResponse->getErrorList() as $error){
            echo $error . '<br/>';
        }
    }
    die;
} else {
    echo '<br/><br/> Les éléments de Create refund voucher sont : <br/><br/>';
    
    echo 'Order Number : ' . $createRefundVoucherResponse->getOrderNumber() . '<br/>';
    
    echo '<br/><br/>-------------- COMMERCIAL GESTURE LIST----------------------<br/><br/>';
    
    /*
     * \Sdk\Order\Refund\RefundInformationMessage
     */
    foreach ($createRefundVoucherResponse->getCommercialGestures()->getCommercialGestureResultList() as $commercialGesture) {
        
        if ($commercialGesture->isOperationSuccess() == true) {
            echo 'OPERATION SUCCESS : ' . $commercialGesture->isOperationSuccess() . '<br/>';
            echo 'AMOUNT            : ' . $commercialGesture->getAmountResult() . '<br/>';
            echo 'MOTIVE ID         : ' . $commercialGesture->getMotiveIdResult() . '<br/>';
        }else {
            echo 'error in commercial gesture : <br/>';
            echo 'ERROR MESSAGE : ' . $commercialGesture->getErrorMessage() . '<br/>';
        }
    }
    
    echo '<br/><br/>-------------- SELLER REFUND RESULT LIST----------------------<br/><br/>';
    
    /*
     * \Sdk\Order\Refund\SellerRefundResult
     */
    foreach ($createRefundVoucherResponse->getSellerRefunds()->getSellerRefundResultList() as $sellerRefundResult) {
        
        if ($sellerRefundResult->isOperationSuccess() == TRUE) {
            echo 'OPERATION SUCCESS : ' . $sellerRefundResult->isOperationSuccess() . '<br/>';
            echo 'EAN               : ' . $sellerRefundResult->getEanResult() . '<br/>';
            echo 'MOTIVE            : ' . $sellerRefundResult->getMotiveResult() . '<br/>';
            echo 'SELLER PRODUCT ID : ' . $sellerRefundResult->getSellerProductIdResult() . '<br/>';
            echo 'VALUE             : ' . $sellerRefundResult->getValueResult() . '<br/>';
        } else {
            echo 'error in seller refund result list <br>';
            echo 'ERROR MESSAGE : ' . $sellerRefundResult->getErrorMessage() . '<br/>';
        }
    }
}


