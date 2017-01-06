<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 17:22
 */

namespace Sdk\Order;


class Corporation
{

    /**
     * @var int
     */
    private $_businessUnitId = 0;

    /**
     * @return int
     */
    public function getBusinessUnitId()
    {
        return $this->_businessUnitId;
    }

    /**
     * @param int $businessUnitId
     */
    public function setBusinessUnitId($businessUnitId)
    {
        $this->_businessUnitId = $businessUnitId;
    }

    /**
     * @var string
     */
    private $_corporationCode = null;

    /**
     * @return string
     */
    public function getCorporationCode()
    {
        return $this->_corporationCode;
    }

    /**
     * @param string $corporationCode
     */
    public function setCorporationCode($corporationCode)
    {
        $this->_corporationCode = $corporationCode;
    }

    /**
     * @var int
     */
    private $_corporationId = 0;

    /**
     * @return int
     */
    public function getCorporationId()
    {
        return $this->_corporationId;
    }

    /**
     * @param int $corporationId
     */
    public function setCorporationId($corporationId)
    {
        $this->_corporationId = $corporationId;
    }

    /**
     * @var string
     */
    private $_corporationName = null;

    /**
     * @return string
     */
    public function getCorporationName()
    {
        return $this->_corporationName;
    }

    /**
     * @param string $corporationName
     */
    public function setCorporationName($corporationName)
    {
        $this->_corporationName = $corporationName;
    }

    /**
     * @var bool
     */
    private $_isMarketPlaceActive = false;

    /**
     * @return boolean
     */
    public function isIsMarketPlaceActive()
    {
        return $this->_isMarketPlaceActive;
    }

    /**
     * @param boolean $isMarketPlaceActive
     */
    public function setIsMarketPlaceActive($isMarketPlaceActive)
    {
        $this->_isMarketPlaceActive = $isMarketPlaceActive;
    }
}