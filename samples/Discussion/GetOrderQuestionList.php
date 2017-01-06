<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 11:43
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


/******************   GET ORDER QUESTION LIST  ***************/

$discussionPoint = $client->getDiscussionPoint();

$orderQuestionFilter = new \Sdk\Discussion\OrderQuestionFilter();

$orderQuestionFilter->setBeginCreationDate('2016-10-30T00:00:00.00');
$orderQuestionFilter->setBeginModificationDate('2016-10-30T01:00:00.00');
$orderQuestionFilter->setEndCreationDate('2016-11-09T23:59:59.99');
$orderQuestionFilter->setEndModificationDate('2016-11-09T02:00:00.00');

$orderQuestionFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Open);
$orderQuestionFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Closed);

$discussionResponse = $discussionPoint->getOrderQuestionList($orderQuestionFilter);

/** @var \Sdk\Discussion\OrderQuestion $orderQuestion */
foreach ($discussionResponse->getOrderQuestionList() as $orderQuestion) {
    echo "<br/><br/>-----------------------------------<br/>";

    echo "ID : " . $orderQuestion->getId() . " - le " . $orderQuestion->getCreationDate() . "<br/>";
    echo "Statut de la discussion : " . $orderQuestion->getStatus() . " - Sujet : " . $orderQuestion->getSubject() . "<br/>";

    /** @var \Sdk\Discussion\Message $message */
    foreach ($orderQuestion->getMessageList() as $message) {
        echo "<b>Message : </b>" . $message->getContent() . " <b>de</b> " . $message->getSender() . " <b>le</b> " . $message->getTimestamp() . "<br/><br/>";
    }
}