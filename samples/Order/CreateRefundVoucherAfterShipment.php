<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 20/10/2016
 * Time: 14:40
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

/**********  CREATE REFUND VOUCHER AFTER SHIPMENT ***********/

/**
 * OrderNumber : 1209041030XVM5M
 * SellerRefundRequest>
 * * Mode : Claim
 * * Motive : ClientClaim
 * * RefundOrderLine
 * * * Ean 0021165108288
 * * * SellerProductId PC1890
 * * * RefundShippingCharges true
 */

$orderPoint = $client->getOrderPoint();

$request = new \Sdk\Order\Refund\Request(/* OrderNumber */ '1209041030XVM5M');

$sellerRefundOrderLine = new \Sdk\Order\Refund\RefundOrderLine(/* EAN */ '0021165108288', /* SellerProductId */ 'PC1890', /* RefundShippingCharges */ true);

$sellerRefundRequest = new \Sdk\Order\Refund\SellerRefundRequest($sellerRefundOrderLine);
$sellerRefundRequest->setMode(\Sdk\Order\Refund\RefundRequestModeEnum::Claim);
$sellerRefundRequest->setMotive(\Sdk\Order\Refund\RefundMotiveEnum::ClientClaim);

$request->addSellerRefundRequest($sellerRefundRequest);
//$request->addSellerRefundRequest($sellerRefundRequest);

$createRefundVoucherResponse = $orderPoint->CreateRefundVoucherAfterShipment($request);