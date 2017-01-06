<?php
/**
 * Created by Cdiscount.
 * Date: 02/12/2016
 * Time: 15:22
 */


namespace Sdk\Parcel;


class ParcelShop
{
    /**
     * @var string
     */
    private $_addressComplement = null;

    /**
     * @return string
     */
    public function getAddressComplement()
    {
        return $this->_addressComplement;
    }

    /**
     * @param string $addressComplement
     */
    public function setAddressComplement($addressComplement)
    {
        $this->_addressComplement = $addressComplement;
    }

    /**
     * @var string
     */
    private $_city = null;

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->_city = $city;
    }

    /**
     * @var string
     */
    private $_closingDate = null;

    /**
     * @return string
     */
    public function getClosingDate()
    {
        return $this->_closingDate;
    }

    /**
     * @param string $closingDate
     */
    public function setClosingDate($closingDate)
    {
        $this->_closingDate = $closingDate;
    }

    /**
     * @var string
     */
    private $_exceptionalClosingDate1 = null;

    /**
     * @return string
     */
    public function getExceptionalClosingDate1()
    {
        return $this->_exceptionalClosingDate1;
    }

    /**
     * @param string $exceptionalClosingDate1
     */
    public function setExceptionalClosingDate1($exceptionalClosingDate1)
    {
        $this->_exceptionalClosingDate1 = $exceptionalClosingDate1;
    }

    /**
     * @var string
     */
    private $_exceptionalClosingDate2 = null;

    /**
     * @return string
     */
    public function getExceptionalClosingDate2()
    {
        return $this->_exceptionalClosingDate2;
    }

    /**
     * @param string $exceptionalClosingDate2
     */
    public function setExceptionalClosingDate2($exceptionalClosingDate2)
    {
        $this->_exceptionalClosingDate2 = $exceptionalClosingDate2;
    }

    /**
     * @var string
     */
    private $_exceptionalClosingDate3 = null;

    /**
     * @return string
     */
    public function getExceptionalClosingDate3()
    {
        return $this->_exceptionalClosingDate3;
    }

    /**
     * @param string $exceptionalClosingDate3
     */
    public function setExceptionalClosingDate3($exceptionalClosingDate3)
    {
        $this->_exceptionalClosingDate3 = $exceptionalClosingDate3;
    }

    /**
     * @var string
     */
    private $_exceptionalClosingDate4 = null;

    /**
     * @return string
     */
    public function getExceptionalClosingDate4()
    {
        return $this->_exceptionalClosingDate4;
    }

    /**
     * @param string $exceptionalClosingDate4
     */
    public function setExceptionalClosingDate4($exceptionalClosingDate4)
    {
        $this->_exceptionalClosingDate4 = $exceptionalClosingDate4;
    }

    /**
     * @var string
     */
    private $_exceptionalClosingDate5 = null;

    /**
     * @return string
     */
    public function getExceptionalClosingDate5()
    {
        return $this->_exceptionalClosingDate5;
    }

    /**
     * @param string $exceptionalClosingDate5
     */
    public function setExceptionalClosingDate5($exceptionalClosingDate5)
    {
        $this->_exceptionalClosingDate5 = $exceptionalClosingDate5;
    }

    /**
     * @var string
     */
    private $_fridayAfternoonClosingHour = null;

    /**
     * @return string
     */
    public function getFridayAfternoonClosingHour()
    {
        return $this->_fridayAfternoonClosingHour;
    }

    /**
     * @param string $fridayAfternoonClosingHour
     */
    public function setFridayAfternoonClosingHour($fridayAfternoonClosingHour)
    {
        $this->_fridayAfternoonClosingHour = $fridayAfternoonClosingHour;
    }

    /**
     * @var string
     */
    private $_fridayAfternoonOpeningHour = null;

    /**
     * @return string
     */
    public function getFridayAfternoonOpeningHour()
    {
        return $this->_fridayAfternoonOpeningHour;
    }

    /**
     * @param string $fridayAfternoonOpeningHour
     */
    public function setFridayAfternoonOpeningHour($fridayAfternoonOpeningHour)
    {
        $this->_fridayAfternoonOpeningHour = $fridayAfternoonOpeningHour;
    }

    /**
     * @var string
     */
    private $_fridayMorningClosingHour = null;

    /**
     * @return string
     */
    public function getFridayMorningClosingHour()
    {
        return $this->_fridayMorningClosingHour;
    }

    /**
     * @param string $fridayMorningClosingHour
     */
    public function setFridayMorningClosingHour($fridayMorningClosingHour)
    {
        $this->_fridayMorningClosingHour = $fridayMorningClosingHour;
    }

    /**
     * @var string
     */
    private $_fridayMorningOpeningHour = null;

    /**
     * @return string
     */
    public function getFridayMorningOpeningHour()
    {
        return $this->_fridayMorningOpeningHour;
    }

    /**
     * @param string $fridayMorningOpeningHour
     */
    public function setFridayMorningOpeningHour($fridayMorningOpeningHour)
    {
        $this->_fridayMorningOpeningHour = $fridayMorningOpeningHour;
    }

    /**
     * @var bool
     */
    private $_storeShipmentActive = false;

    /**
     * @return boolean
     */
    public function isStoreShipmentActive()
    {
        return $this->_storeShipmentActive;
    }

    /**
     * @param boolean $storeShipmentActive
     */
    public function setStoreShipmentActive($storeShipmentActive)
    {
        $this->_storeShipmentActive = $storeShipmentActive;
    }

    /**
     * @var bool
     */
    private $_takeAwayDeliveryActive = false;

    /**
     * @return boolean
     */
    public function isTakeAwayDeliveryActive()
    {
        return $this->_takeAwayDeliveryActive;
    }

    /**
     * @param boolean $takeAwayDeliveryActive
     */
    public function setTakeAwayDeliveryActive($takeAwayDeliveryActive)
    {
        $this->_takeAwayDeliveryActive = $takeAwayDeliveryActive;
    }

    /**
     * @var float
     */
    private $_latitude = 0.0;

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->_latitude;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude)
    {
        $this->_latitude = $latitude;
    }

    /**
     * @var float
     */
    private $_longitude = 0.0;

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->_longitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude)
    {
        $this->_longitude = $longitude;
    }

    /**
     * @var string
     */
    private $_locality = null;

    /**
     * @return string
     */
    public function getLocality()
    {
        return $this->_locality;
    }

    /**
     * @param string $locality
     */
    public function setLocality($locality)
    {
        $this->_locality = $locality;
    }

    /**
     * @var string
     */
    private $_mondayAfternoonClosingHour = null;

    /**
     * @return string
     */
    public function getMondayAfternoonClosingHour()
    {
        return $this->_mondayAfternoonClosingHour;
    }

    /**
     * @param string $mondayAfternoonClosingHour
     */
    public function setMondayAfternoonClosingHour($mondayAfternoonClosingHour)
    {
        $this->_mondayAfternoonClosingHour = $mondayAfternoonClosingHour;
    }

    /**
     * @var string
     */
    private $_mondayAfternoonOpeningHour = null;

    /**
     * @return string
     */
    public function getMondayAfternoonOpeningHour()
    {
        return $this->_mondayAfternoonOpeningHour;
    }

    /**
     * @param string $mondayAfternoonOpeningHour
     */
    public function setMondayAfternoonOpeningHour($mondayAfternoonOpeningHour)
    {
        $this->_mondayAfternoonOpeningHour = $mondayAfternoonOpeningHour;
    }

    /**
     * @var string
     */
    private $_mondayMorningClosingHour = null;

    /**
     * @return string
     */
    public function getMondayMorningClosingHour()
    {
        return $this->_mondayMorningClosingHour;
    }

    /**
     * @param string $mondayMorningClosingHour
     */
    public function setMondayMorningClosingHour($mondayMorningClosingHour)
    {
        $this->_mondayMorningClosingHour = $mondayMorningClosingHour;
    }

    /**
     * @var string
     */
    private $_mondayMorningOpeningHour = null;

    /**
     * @return string
     */
    public function getMondayMorningOpeningHour()
    {
        return $this->_mondayMorningOpeningHour;
    }

    /**
     * @param string $mondayMorningOpeningHour
     */
    public function setMondayMorningOpeningHour($mondayMorningOpeningHour)
    {
        $this->_mondayMorningOpeningHour = $mondayMorningOpeningHour;
    }

    /**
     * @var string
     */
    private $_name = null;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @var string
     */
    private $_openingDate = null;

    /**
     * @return string
     */
    public function getOpeningDate()
    {
        return $this->_openingDate;
    }

    /**
     * @param string $openingDate
     */
    public function setOpeningDate($openingDate)
    {
        $this->_openingDate = $openingDate;
    }


}