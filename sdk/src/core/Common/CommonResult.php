<?php
/**
 * Created by Cdiscount.
 * Date: 14/12/2016
 * Time: 14:12
 */


namespace Sdk\Common;


class CommonResult
{
    /**
     * @var string
     */
    private $_errorMessage = null;

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->_errorMessage = $errorMessage;
    }

    /**
     * @var bool
     */
    private $_operationSuccess = false;

    /**
     * @return boolean
     */
    public function isOperationSuccess()
    {
        return $this->_operationSuccess;
    }

    /**
     * @param boolean $operationSuccess
     */
    public function setOperationSuccess($operationSuccess)
    {
        $this->_operationSuccess = $operationSuccess;
    }

    /**
     * @var string
     */
    private $_sellerLogin = null;

    /**
     * @return string
     */
    public function getSellerLogin()
    {
        return $this->_sellerLogin;
    }

    /**
     * @param string $sellerLogin
     */
    public function setSellerLogin($sellerLogin)
    {
        $this->_sellerLogin = $sellerLogin;
    }

    /**
     * @var string
     */
    private $_tokenId = null;

    /**
     * @return string
     */
    public function getTokenId()
    {
        return $this->_tokenId;
    }

    /**
     * @param string $tokenId
     */
    public function setTokenId($tokenId)
    {
        $this->_tokenId = $tokenId;
    }

    /**
     * @var array
     */
    private $_errorList = null;

    /**
     * @return array
     */
    public function getErrorList()
    {
        return $this->_errorList;
    }

    /**
     * @param $error
     */
    public function addErrorToList($error)
    {
        array_push($this->_errorList, $error);
    }

    /**
     * CommonResult constructor.
     */
    public function __construct()
    {
        $this->_errorList = array();
    }
}