<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
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

$claimFilter->setBeginCreationDate('2017-01-01T01:00:00.00');
$claimFilter->setBeginModificationDate('2017-01-01T01:00:00.00');
$claimFilter->setEndCreationDate('2017-02-23T01:00:00.00');
$claimFilter->setEndModificationDate('2017-02-23T01:00:00.00');
$claimFilter->addOrderNumber('1602092055KOFEB');

//$claimFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Open);
$claimFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::All);

$discussionResponse = $discussionPoint->getOrderClaimList($claimFilter);

if (count($discussionResponse->getOrderClaimList()) == 0) {
    echo "Aucune discussion ne correspond à ces dates.<br/>";
}

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