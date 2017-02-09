<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 09:41
 */

namespace Sdk\Soap\Common;


abstract class iResponse
{
    /**
     * @var
     */
    protected $_errorMessage;

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * @var
     */
    protected $_operationSuccess;

    /**
     * @return mixed
     */
    public function getOperationSuccess()
    {
        return $this->_operationSuccess;
    }

    /**
     * @var
     */
    protected $_errorList;

    /**
     * @return mixed
     */
    public function getErrorList()
    {
        return $this->_errorList;
    }

    /**
     * @var
     */
    protected $_sellerLogin;

    /**
     * @return mixed
     */
    public function getSellerLogin()
    {
        return $this->_sellerLogin;
    }

    /**
     * @var
     */
    protected $_tokenID;

    /**
     * @return mixed
     */
    public function getTokenID()
    {
        return $this->_tokenID;
    }

    protected $_hasError = false;

    /**
     * @return boolean
     */
    public function hasError()
    {
        return $this->_hasError;
    }

    /**
     * Check error message and operation success flag
     * @param $headerResult
     * @return bool
     */
    protected function isOperationSuccess($headerResult)
    {
        $objError = $headerResult['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {
            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
        }
        if (isset($headerResult['OperationSuccess']['_']) && $headerResult['OperationSuccess']['_'] == 'true') {
            return true;
        }
        return false;
    }

}