<?php
/*
 * Created by Mohamed MGUILD
 * Date: 10/05/2017
 */

namespace Sdk\Fulfilment;

class FulfilmentDeliveryDocumentRequest
{   
    /**
     * @var int
     */
    private $_depositId = null;
    
    /**
     * @return int
     */
    public function getDepositId()
    {
        return $this->_depositId;
    }

    /*
     * @param $depositId
     */
    public function setDepositId($depositId)
    {
        $this->_depositId = $depositId;
    }

    /*
     * FulfilmentDeliveryDocumentRequest constructor
     * @param $depositId int
     */
    public function __construct($depositId) 
    {
        $this-> _depositId = $depositId;
    }
}


