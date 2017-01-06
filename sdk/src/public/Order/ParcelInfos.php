<?php
/**
 * Created by Cdiscount.
 * Date: 13/12/2016
 * Time: 14:06
 */


namespace Sdk\Order;


class ParcelInfos
{

    /**
     * @var String
     */
    private $_parcelNumber = null;

    /**
     * @return String
     */
    public function getParcelNumber()
    {
        return $this->_parcelNumber;
    }

    /**
     * @var string
     */
    private $_sku = null;

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->_sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->_sku = $sku;
    }

    /**
     * ParcelInfos constructor.
     * @param $parcelNumber
     */
    public function __construct($parcelNumber)
    {
        $this->_parcelNumber = $parcelNumber;
    }

    /**
     * @var string
     */
    private $_parcelActions = null;

    /**
     * @return string
     */
    public function getParcelActions()
    {
        return $this->_parcelActions;
    }

    /**
     * @param string $parcelActions
     */
    public function setParcelActions($parcelActions)
    {
        $this->_parcelActions = $parcelActions;
    }
}