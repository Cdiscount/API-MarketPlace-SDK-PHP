<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 11:25
 */

namespace Sdk\Discussion;


use Sdk\Soap\Common\SoapTools;

class OrderClaim extends GenericQuestion
{
    /**
     * @var string
     */
    private $_orderNumber = null;

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->_orderNumber;
    }

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        if (!SoapTools::isSoapValueNull($orderNumber)) {
            $this->_orderNumber = $orderNumber;
        }
    }

    /**
     * @var string
     */
    private $_claimType = null;

    /**
     * @return string
     */
    public function getClaimType()
    {
        return $this->_claimType;
    }

    /**
     * @param string $claimType
     */
    public function setClaimType($claimType)
    {
        if (!SoapTools::isSoapValueNull($claimType)) {
            $this->_claimType = $claimType;
        }
    }

    /**
     * @var string
     */
    private $_discussionType = null;

    /**
     * @return string
     */
    public function getDiscussionType()
    {
        return $this->_discussionType;
    }

    /**
     * @param string $discussionType
     */
    public function setDiscussionType($discussionType)
    {
        if (!SoapTools::isSoapValueNull($discussionType)) {
            $this->_discussionType = $discussionType;
        }
    }
}