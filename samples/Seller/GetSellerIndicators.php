
<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 16/11/2016
 * Time: 10:45
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

/****************** GET SELLER INDICATORS ****************/

$sellerPoint = $client->getSellerPoint();

$getSellerIndicatorsResponse = $sellerPoint->getSellerIndicators();

if ($getSellerIndicatorsResponse->hasError()) {
    foreach ($getSellerIndicatorsResponse->getErrorList() as $error) {
        echo $error . "<br/>";
    }
    die;
}

if ($getSellerIndicatorsResponse->getSellerIndicators() != null) {

    /** @var \Sdk\Seller\SellerIndicator $indicator */
    foreach ($getSellerIndicatorsResponse->getSellerIndicators() as $indicator) {
        echo "<br/>SellerIndicator<br/>";
        echo "ComputationDate: " . $indicator->getComputationDate() . "<br/>";
        echo "Description: " . $indicator->getDescription() . "<br/>";
        echo "Threshold: " . $indicator->getThreshold() . "<br/>";
        echo "ThresholdType: " . $indicator->getThresholdType() . "<br/>";
        echo "ValueD30: " . $indicator->getValueD30() . "<br/>";
        echo "ValueD60: " . $indicator->getValueD60() . "<br/>";
    }
}