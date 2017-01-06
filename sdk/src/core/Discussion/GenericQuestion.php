<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 10:45
 */

namespace Sdk\Discussion;


use Sdk\Soap\Common\SoapTools;

class GenericQuestion
{
    /**
     * @var string
     */
    private $_closeDate = null;

    /**
     * @return string
     */
    public function getCloseDate()
    {
        return $this->_closeDate;
    }

    /**
     * @param string $closeDate
     */
    public function setCloseDate($closeDate)
    {
        if (!SoapTools::isSoapValueNull($closeDate)) {
            $this->_closeDate = $closeDate;
        }
    }

    /**
     * @var string
     */
    private $_creationDate = null;

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        if (!SoapTools::isSoapValueNull($creationDate)) {
            $this->_creationDate = $creationDate;
        }
    }

    /**
     * @var string
     */
    private $_lastUpdatedDate = null;

    /**
     * @return string
     */
    public function getLastUpdatedDate()
    {
        return $this->_lastUpdatedDate;
    }

    /**
     * @param string $lastUpdatedDate
     */
    public function setLastUpdatedDate($lastUpdatedDate)
    {
        if (!SoapTools::isSoapValueNull($lastUpdatedDate)) {
            $this->_lastUpdatedDate = $lastUpdatedDate;
        }
    }

    /**
     * @var array
     */
    private $_messageList = null;

    /**
     * @return array
     */
    public function getMessageList()
    {
        return $this->_messageList;
    }

    /**
     * @param $message \Sdk\Discussion\Message
     */
    public function addMessageToList($message)
    {
        if ($this->_messageList == null) {
            $this->_messageList = array();
        }
        if ($message != null) {
            array_push($this->_messageList, $message);
        }
    }

    /**
     * @var string
     */
    private $_status = null;

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        if (!SoapTools::isSoapValueNull($status)) {
            $this->_status = $status;
        }
    }

    /**
     * @var string
     */
    private $_subject = null;

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->_subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        if (!SoapTools::isSoapValueNull($subject)) {
            $this->_subject = $subject;
        }
    }

    /**
     * @var int
     */
    private $_id = 0;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * OrderClaim constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->_id = $id;
    }
}