<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/11/2016
 * Time: 16:04
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

$mailPoint = $client->getMailPoint();

$discussionIDS = array(/* Discussions IDs */ 37631699, 37630160, 37626714);

$getDiscussionMailListResponse = $mailPoint->getDiscussionMailList($discussionIDS);

/** @var \Sdk\Mail\DiscussionMail $discussionMail */
foreach ($getDiscussionMailListResponse->getDiscussionMailList() as $discussionMail) {
    echo "DiscussionMail::DiscussionId : " . $discussionMail->getDiscussionId() . "<br/>";
    echo "DiscussionMail::MailAddress : " . ($discussionMail->getMailAddress() == null ? 'null' : $discussionMail->getMailAddress()) . "<br/>";
    echo "DiscussionMail::OperationStatus : " . ($discussionMail->getOperationStatus() == null ? 'null' : $discussionMail->getOperationStatus()) . "<br/><br/>";
}
