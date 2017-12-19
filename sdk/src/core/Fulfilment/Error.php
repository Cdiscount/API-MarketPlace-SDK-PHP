<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class Error
{
        
    /*
     * @var int
     */
    private $_errorCode = null;

     /*
     * @var string
     */
    private $_errorMessage = null;

    /*
     * @return int
     */
    public function getErrorCode()
    {
        return $this->_errorCode;
    }

    /*
     * @param $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->_errorCode=$errorCode;
    }

    /*
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /*
     * @param $errorMessage
     */
    public function setErrorMessage($errorMessage)
    {
        $this->_errorMessage=$errorMessage;
    }
}
