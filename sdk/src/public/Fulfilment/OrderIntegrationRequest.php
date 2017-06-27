<?php
/**
 * Created by ElIbaoui Otmane (SQLI)
 * Date: 05/05/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

/**
 * Order Integration Request
 */
class OrderIntegrationRequest
{
    /**
     * @var ExternalOrder
     */
    private $_externalOrder = null;

    /**
     * @return ExternalOrder
     */
    public function getExternalOrder()
    {
        return $this->_externalOrder;
    }

    /**
     * @param ExternalOrder $externalOrder 
     */
    public function setExternalOrder($externalOrder)
    {
        $this->_externalOrder = $externalOrder;
    }
}