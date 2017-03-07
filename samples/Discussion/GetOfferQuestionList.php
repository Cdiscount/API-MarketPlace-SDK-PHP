<?php

/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 04/11/2016
 * Time: 11:11
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

/*************     GetOfferQuestionList     **************/

$discussionPoint = $client->getDiscussionPoint();

$offerQuestionFilter = new \Sdk\Discussion\OfferQuestionFilter();

$offerQuestionFilter->setBeginCreationDate('2016-10-20T00:00:00.00');
$offerQuestionFilter->setBeginModificationDate('2016-10-20T01:00:00.00');
$offerQuestionFilter->setEndCreationDate('2016-11-03T23:59:59.99');
$offerQuestionFilter->setEndModificationDate('2016-11-03T02:00:00.00');

$offerQuestionFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Open);
$offerQuestionFilter->addStatus(\Sdk\Discussion\DiscussionStatusEnum::Closed);

$discussionResponse = $discussionPoint->getOfferQuestionList($offerQuestionFilter);

/** @var \Sdk\Discussion\OfferQuestion $offerQuestion */
foreach ($discussionResponse->getOfferQuestionList() as $offerQuestion) {
    echo "-----------------------------------<br/>";

    echo "ID : " . $offerQuestion->getId() . " - le " . $offerQuestion->getCreationDate() . "<br/>";
    echo "Statut de la discussion : " . $offerQuestion->getStatus() . " - Sujet : " . $offerQuestion->getSubject() . " - productEAN : " . $offerQuestion->getProductEAN() . "<br/>";

    /** @var \Sdk\Discussion\Message $message */
    foreach ($offerQuestion->getMessageList() as $message) {
        echo "Message : " . $message->getContent() . " de " . $message->getSender() . " le " . $message->getTimestamp() . "<br/>";
    }
}