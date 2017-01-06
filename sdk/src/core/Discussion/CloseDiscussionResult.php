<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 14:24
 */

namespace Sdk\Discussion;


class CloseDiscussionResult
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
     * CloseDiscussionResult constructor.
     * @param $discussionID
     */
    public function __construct($discussionID)
    {
        $this->_discussionId = $discussionID;
    }
}