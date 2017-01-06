## 1- Install a web server (for example wamp for windows)

### 1.1 - Min requirements :

*   Apache 2.2
*   Php 5.6

## 2- Clone the Git repository in your root project folder

The SDK is structured like that :

*   config/ : config files
*   samples/ : samples folder
*   sdk/ : content of the Cdiscount SDK (do not modifiy any file of this folder)

## 3 - Insert your API's credentials

### 3.1 - Requirements

To use Cdiscount Marketplace API and Cdiscount Marketplace SDK you first need to follow the steps described in the Cdiscount Marketplace API website.

The sections are the following :

*   Request your account creation.
*   Have set up your account

### 3.2 - Update the config files

Follow the procedure to insert your API credentials

*   Open the config folder
*   Open the config.ini file
*   Set the api mode : 'preprod' or 'prod'
*   Open the preprod.config.ini file or the prod.config.ini file (if you set mode to 'prod')
*   Set your api username
*   Set your api password

## 4 - Use the SDK

### 4.1 - Use the endpoints

The SDK contains the following endpoints :

*   Seller
*   Offer
*   Discussion
*   Product
*   Order
*   Relay

All the SDK methods are described in the MarketPlace API Website because they have the same names of the Cdiscount Marketplace API methods.

For each method, you have a PHP file with a sample to call the corresponding API function.

For example, to call the GetSellerInformation API method, open the GetSellerInformation.php file contained in the Seller folder and follow the same steps of the sample.

### 4.2 - CDSApiClient Object

The CDSApiClient allows you to call the API.

The CDSApiClient object contains all the endpoints. It's also create an API call to get a token for you.

Don't create a new CDSApiClient each time you call the API !

You can (have to) use the same CDSApiClient for all your API' calls.

Here an example of how use the same CDSApiClient for many API calls :

`$client = new \Sdk\ApiClient\CDSApiClient(); $token = $client->init(); if ($token == null || !$client->isTokenValid()) { echo "Souci lors de la génération du token"; die; } $offerPoint = $client->getOfferPoint(); $offerListResponse = $offerPoint->getOfferList(null); /** Parse here $offerListResponse **/ $sellerPoint = $client->getSellerPoint(); $sellerResponse = $sellerPoint->getSellerInformation(); /** Parse here $sellerResponse **/`


## 5 - Update the SDK
Download the new SDK Zip file from the CDiscount Marketplace API Website

Erase the SDK folder with the new one

Erase the vendor folder with the new one

## Notes
In the sample, the parametrer error_reporting is set to '-1'. Do not let it in production mode.