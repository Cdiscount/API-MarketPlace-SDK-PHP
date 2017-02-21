<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 14:38
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    $client->getTokenGenerationError()->displayErrorMessage();
    die;
}

/*****************    GET SELLER INFORMATION   ***************/

$sellerPoint = $client->getSellerPoint();

$sellerResponse = $sellerPoint->getSellerInformation();

if ($sellerResponse->hasError()) {
    echo $sellerResponse->getErrorMessage();
}
else {
    $seller = $sellerResponse->getSeller();

    echo "Email : " . $seller->getEmail() . "<br/>";
    echo "Login : " . $seller->getLogin() . "<br/>";
    echo "MobileNumber : " . $seller->getMobileNumber() . "<br/>";
    echo "PhoneNumber : " . $seller->getPhoneNumber() . "<br/><br/>";

    echo "SellerAddress::Address1 : " . $seller->getSellerAddress()->getAddress1() . "<br/>";
    echo "SellerAddress::ZipCode : " . $seller->getSellerAddress()->getZipCode() . "<br/>";
    echo "SellerAddress::City : " . $seller->getSellerAddress()->getCity() . "<br/>";
    echo "SellerAddress::Country : " . $seller->getSellerAddress()->getCountry() . "<br/><br/>";

    echo "SIRET : " . $seller->getSiretNumber() . "<br/>";
    echo "ShopName : " . $seller->getShopName() . "<br/>";
}


