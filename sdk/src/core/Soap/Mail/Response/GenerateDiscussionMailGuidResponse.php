<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/11/2016
 * Time: 16:32
 */

namespace Sdk\Soap\Mail\Response;


use Sdk\Soap\Common\iResponse;

class GenerateDiscussionMailGuidResponse extends iResponse
{
    /**
     * @var array|null
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_discussionMailGuidList = null;

    /**
     * @return array
     */
    public function getDiscussionMailGuidList()
    {
        return $this->_discussionMailGuidList;
    }

    /**
     * GetDiscussionMailListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        /** Check For error message */
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_discussionMailList = array();

            //$this->_generateDiscussionMailListFromXML($this->_dataResponse['s:Body']['GetDiscussionMailListResponse']['GetDiscussionMailListResult']['DiscussionMailList']);
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GenerateDiscussionMailGuidResponse']['GenerateDiscussionMailGuidResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GenerateDiscussionMailGuidResponse']['GenerateDiscussionMailGuidResult']['ErrorMessage'];
        $this->_errorList = array();

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            array_push($this->_errorList, $this->_errorMessage);
            return true;
        }
        return false;
    }

    /**
     * @param $discussionMailListXML
     */
    private function _generateDiscussionMailGuidFromXML($discussionMailListXML)
    {
        $discussionMail = new DiscussionMail(intval($discussionMailListXML['DiscussionMail']['DiscussionId']));
        if (isset($discussionMailListXML['DiscussionMail']['OperationStatus']) && !SoapTools::isSoapValueNull($discussionMailListXML['DiscussionMail']['OperationStatus'])) {
            $discussionMail->setOperationStatus($discussionMailListXML['DiscussionMail']['OperationStatus']);
        }
        if (isset($discussionMailListXML['DiscussionMail']['MailAddress']) && !SoapTools::isSoapValueNull($discussionMailListXML['DiscussionMail']['MailAddress'])) {
            $discussionMail->setMailAddress($discussionMailListXML['DiscussionMail']['MailAddress']);
        }
        array_push($this->_discussionMailList, $discussionMail);
    }
}