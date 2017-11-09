<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 11:11
 */

namespace Sdk\Soap\Discussion\Response;


use Sdk\Discussion\Message;
use Sdk\Discussion\OrderClaim;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class GetOrderClaimListResponse extends iResponse
{

    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_orderClaimList = null;

    /**
     * @return array
     */
    public function getOrderClaimList()
    {
        return $this->_orderClaimList;
    }

    /**
     * GetOrderClaimListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check For error message
        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['GetOrderClaimListResponse']['GetOrderClaimListResult'])) {
            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_orderClaimList = array();

            if (!SoapTools::isSoapValueNull($this->_dataResponse['s:Body']['GetOrderClaimListResponse']['GetOrderClaimListResult']['OrderClaimList'])) {
                $this->_generateOrderClaimListFromXML($this->_dataResponse['s:Body']['GetOrderClaimListResponse']['GetOrderClaimListResult']['OrderClaimList']);
            }
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOrderClaimListResponse']['GetOrderClaimListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * @param $orderClaimList
     */
    private function _generateOrderClaimListFromXML($orderClaimList)
    {
        foreach ($orderClaimList['OrderClaim'] as $orderClaimXML) {

            $orderClaim = new OrderClaim($orderClaimXML['Id']);
            $orderClaim->setCloseDate($orderClaimXML['CloseDate']);
            $orderClaim->setCreationDate($orderClaimXML['CreationDate']);
            $orderClaim->setLastUpdatedDate($orderClaimXML['LastUpdatedDate']);
            if (isset($orderClaimXML['Status'])) {
                $orderClaim->setStatus($orderClaimXML['Status']);
            }
            if (isset($orderClaimXML['Subject'])) {
                $orderClaim->setSubject($orderClaimXML['Subject']);
            }
            if (isset($orderClaimXML['OrderNumber'])) {
                $orderClaim->setOrderNumber($orderClaimXML['OrderNumber']);
            }
            if (isset($orderClaimXML['ClaimType'])) {
                $orderClaim->setClaimType($orderClaimXML['ClaimType']);
            }

            $manyMessage = true;
            foreach ($orderClaimXML['Messages']['Message'] as $messageXML) {

                if (!isset($messageXML['Content'])) {
                    $manyMessage = false;
                    break;
                }
                $message = new Message();
                $message->setContent($messageXML['Content']);

                if (isset($messageXML['Sender'])) {
                    $message->setSender($messageXML['Sender']);
                }

                if (isset($messageXML['Timestamp'])) {
                    $message->setTimestamp($messageXML['Timestamp']);
                }
                $orderClaim->addMessageToList($message);
            }

            if (!$manyMessage) {

                $message = new Message();
                $message->setContent($orderClaimXML['Messages']['Message']['Content']);
                $message->setSender($orderClaimXML['Messages']['Message']['Sender']);
                $message->setTimestamp($orderClaimXML['Messages']['Message']['Timestamp']);
                $orderClaim->addMessageToList($message);
            }
            array_push($this->_orderClaimList, $orderClaim);
        }
    }


}
