<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 09/11/2016
 * Time: 14:43
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


/**************    CLOSE DISCUSSION LIST    *************/

$discussionPoint = $client->getDiscussionPoint();

$discussionIds = array(/* Discussion ID */ 37677947);

$closeDiscussionListResponse = $discussionPoint->closeDiscussionList($discussionIds);

echo "Seller Login : " . $closeDiscussionListResponse->getSellerLogin() . "<br/>";
echo "TokenID : " . $closeDiscussionListResponse->getTokenID() . "<br/>";

if ($closeDiscussionListResponse->getCloseDiscussionResultList() != null) {

    /** @var \Sdk\Discussion\CloseDiscussionResult $closeDiscussionResult */
    foreach ($closeDiscussionListResponse->getCloseDiscussionResultList() as $closeDiscussionResult) {
        echo "CloseDiscussionResult::DiscussionId : " . $closeDiscussionResult->getDiscussionId() . "<br/>";
        echo "CloseDiscussionResult::OperationStatus : " . $closeDiscussionResult->getOperationStatus() . "<br/><br/><br/>";
    }
}

