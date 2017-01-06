<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 16:26
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

/****************   GetOrderClaimList  ******************/

$discussionPoint = $client->getDiscussionPoint();

$claimFilter = new \Sdk\Discussion\ClaimFilter();

$claimFilter->setBeginCreationDate('2016-10-01T00:00:00.00');
$claimFilter->setBeginModificationDate('2016-10-01T01:00:00.00');
$claimFilter->setEndCreationDate('2016-10-20T23:59:59.99');
$claimFilter->setEndModificationDate('2016-10-20T02:00:00.00');

$claimFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Open);
//$claimFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Closed);

$discussionResponse = $discussionPoint->getOrderClaimList($claimFilter);

/** @var \Sdk\Discussion\OrderClaim $orderClaim */
foreach ($discussionResponse->getOrderClaimList() as $orderClaim) {
    echo "-----------------------------------<br/>";

    echo "ID : " . $orderClaim->getId() . " - le " . $orderClaim->getCreationDate() . "<br/>";
    echo "Statut de la discussion : " . $orderClaim->getStatus() . " - Sujet : " . $orderClaim->getSubject() . "<br/><br/>";

    /** @var \Sdk\Discussion\Message $message */
    foreach ($orderClaim->getMessageList() as $message) {
        echo "<b>Message : </b>" . $message->getContent() . " <b>de</b> " . $message->getSender() . " <b>le</b> " . $message->getTimestamp() . "<br/><br/>";
    }
}