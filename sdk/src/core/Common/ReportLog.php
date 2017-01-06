<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 09:53
 */

namespace Sdk\Common;


use Sdk\Soap\Common\SoapTools;

class ReportLog
{
    /**
     * @var string
     */
    private $_logDate = null;

    /**
     * @return string
     */
    public function getLogDate()
    {
        return $this->_logDate;
    }

    /**
     * @param string $logDate
     */
    public function setLogDate($logDate)
    {
        if (!SoapTools::isSoapValueNull($logDate)) {
            $this->_logDate = $logDate;
        }
    }

    /**
     * @var string
     */
    private $_SKU = null;

    /**
     * @return string
     */
    public function getSKU()
    {
        return $this->_SKU;
    }

    /**
     * @param string $SKU
     */
    public function setSKU($SKU)
    {
        if (!SoapTools::isSoapValueNull($SKU)) {
            $this->_SKU = $SKU;
        }
    }

    /**
     * @var bool
     */
    private $_validated = false;

    /**
     * @return boolean
     */
    public function isValidated()
    {
        return $this->_validated;
    }

    /**
     * @param boolean $validated
     */
    public function setValidated($validated)
    {
        $this->_validated = $validated;
    }

    /**
     * @var array
     */
    protected $_propertyList = null;

    /**
     * @return array
     */
    public function getPropertyList()
    {
        return $this->_propertyList;
    }
}