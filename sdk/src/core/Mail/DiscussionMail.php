<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 17:32
 */

namespace Sdk\Mail;


class DiscussionMail
{
    /**
     * @var int
     */
    private $_discussionId = 0;

    /**
     * @return int
     */
    public function getDiscussionId()
    {
        return $this->_discussionId;
    }

    /**
     * @var string
     */
    private $_mailAddress = null;

    /**
     * @return string
     */
    public function getMailAddress()
    {
        return $this->_mailAddress;
    }

    /**
     * @param string $mailAddress
     */
    public function setMailAddress($mailAddress)
    {
        $this->_mailAddress = $mailAddress;
    }

    /**
     * @var string
     */
    private $_operationStatus = null;

    /**
     * @return string
     */
    public function getOperationStatus()
    {
        return $this->_operationStatus;
    }

    /**
     * @param string $operationStatus
     */
    public function setOperationStatus($operationStatus)
    {
        $this->_operationStatus = $operationStatus;
    }

    /**
     * DiscussionMail constructor.
     * @param $discussionId
     */
    public function __construct($discussionId)
    {
        $this->_discussionId = $discussionId;
    }
}