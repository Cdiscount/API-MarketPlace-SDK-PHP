<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 11:28
 */

namespace Sdk\Discussion;


use Sdk\Soap\Common\SoapTools;

class Message
{
    /**
     * @var string
     */
    private $_content = null;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->_content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        if (!SoapTools::isSoapValueNull($content) && !is_array($content)) {
            $this->_content = $content;
        }
    }

    /**
     * @var string
     */
    private $_sender = null;

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->_sender;
    }

    /**
     * @param string $sender
     */
    public function setSender($sender)
    {
        if (!SoapTools::isSoapValueNull($sender)) {
            $this->_sender = $sender;
        }
    }

    /**
     * @var string
     */
    private $_timestamp = null;

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp($timestamp)
    {
        if (!SoapTools::isSoapValueNull($timestamp)) {
            $this->_timestamp = $timestamp;
        }
    }
}