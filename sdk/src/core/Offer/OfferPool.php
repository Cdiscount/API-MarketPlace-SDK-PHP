<?php

namespace Sdk\Offer;
use Sdk\Soap\Common\SoapTools;

/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 13:34
 */
class OfferPool
{
    /**
     * @var string
     */
    private $_description = null;

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @var string
     */
    private $_id = null;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * OfferPool constructor.
     * @param $id
     * @param $description
     */
    public function __construct($id, $description)
    {
        $this->_id = $id;
        if (!SoapTools::isSoapValueNull($description)) {
            $this->_description = $description;
        }
    }
}