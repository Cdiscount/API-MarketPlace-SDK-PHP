<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 13:32
 */

namespace Sdk\Soap\Discussion\Response;


use Sdk\Discussion\CloseDiscussionResult;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class CloseDiscussionListResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse = null;

    /**
     * @var array
     */
    private $_closeDiscussionResultList = null;

    /**
     * @return array
     */
    public function getCloseDiscussionResultList()
    {
        return $this->_closeDiscussionResultList;
    }

    /**
     * GetOrderQuestionListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {

        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $this->_closeDiscussionResultList = array();

            if (isset($this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['CloseDiscussionResultList']) &&
                !SoapTools::isSoapValueNull($this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['CloseDiscussionResultList'])
            ) {
                $this->_generateCloseDiscussionResultList($this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['CloseDiscussionResultList']);
            }
        }
    }

    /**
     * Set the token ID and the seller login from the response
     */
    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * Check if the response has an error message
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['CloseDiscussionListResponse']['CloseDiscussionListResult']['ErrorMessage'];
        $this->_errorList = array();

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            array_push($this->_errorList, $this->_errorMessage);
            return true;
        }
        return false;
    }

    private function _generateCloseDiscussionResultList($closeDiscussionResultListXML)
    {
        foreach ($closeDiscussionResultListXML['CloseDiscussionResult'] as $closeDiscussionXML) {

            $closeDiscussionResult = new CloseDiscussionResult(intval($closeDiscussionXML['DiscussionId']));
            $closeDiscussionResult->setOperationStatus($closeDiscussionXML['OperationStatus']);
        }
    }
}