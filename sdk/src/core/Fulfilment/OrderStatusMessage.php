<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/05/2017
 * Time: 09:52
 */

namespace Sdk\Fulfilment;

/**
 * Order Status Message class
 */
class OrderStatusMessage
{
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
        $this->_status = $status;
    }
}