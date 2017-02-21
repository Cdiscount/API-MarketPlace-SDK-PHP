<?php
/**
 * Created by Guillaume COCHARD.
 * Date: 08/02/2017
 * Time: 15:53
 */

namespace Sdk\Core\Common;

/**
 * Class ErrorMessage
 * Common Error message
 * @package Sdk\Common
 */
class ErrorMessage
{
    /**
     * @var String
     */
    private $_errorMessage = null;

    /**
     * ErrorMessage constructor.
     *
     * @param $errorMessage
     */
    public function __construct($errorMessage)
    {
        $this->_errorMessage = $errorMessage;
    }

    /**
     * Display the error message
     */
    public function displayErrorMessage()
    {
        echo $this->_errorMessage . "<br/>";
    }

    /**
     * @return String
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }
}