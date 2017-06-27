<?php
/**
 * Created by El Ibaoui Otmane (SQLI)
 * Date: 05/05/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

/**
 * ExternalCustomer
 */
class ExternalCustomer
{

    /*
     * @var String
     */
    private $_civility = null;
    
    /*
     * @return string
     */
    public function getCivility()
    {
        return $this->_civility;
    }
    
    /*
     * @param $civility
     */
    public function setCivility($civility)
    {
        $this->_civility = $civility;
    }   
    
    /*
     * @var String
     */
    private $_customerFirstName = null;
    
    /*
     * @return string
     */
    public function getCustomerFirstName()
    {
        return $this->_customerFirstName;
    }
    
    /*
     * @param $customerFirstName
     */
    public function setCustomerFirstName($customerFirstName)
    {
        $this->_customerFirstName = $customerFirstName;
    }    

    /*
     * @var String
     */
    private $_customerLastName = null;
    
    /*
     * @return String
     */
    public function getCustomerLastName()
    {
        return $this->_customerLastName;
    }
    
    /*
     * @param $customerLastName
     */
    public function setCustomerLastName($customerLastName)
    {
        $this->_customerLastName = $customerLastName;
    }    

    /*
     * @var String
     */
    private $_customerEmailAddress = null;
    
    /*
     * @return String
     */
    public function getCustomerEmailAddress()
    {
        return $this->_customerEmailAddress;
    }
    
    /*
     * @param $customerEmailAddress
     */
    public function setCustomerEmailAddress($customerEmailAddress)
    {
        $this->_customerEmailAddress = $customerEmailAddress;
    }    

    /*
     * @var String
     */
    private $_shippingAddress = null;
    
    /*
     * @return String
     */
    public function getShippingAddress()
    {
        return $this->_shippingAddress;
    }
    
    /*
     * @param $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->_shippingAddress = $shippingAddress;
    }    

    /*
     * @var String
     */
    private $_additionalShippingAddress = null;
    
    /*
     * @return String
     */
    public function getAdditionalShippingAddress()
    {
        return $this->_additionalShippingAddress;
    }
    
    /*
     * @param $additionalShippingAddress
     */
    public function setAdditionalShippingAddress($additionalShippingAddress)
    {
        $this->_additionalShippingAddress = $additionalShippingAddress;
    }    

    /*
     * @var String
     */
    private $_locality = null;
    
    /*
     * @return String
     */
    public function getLocality()
    {
        return $this->_locality;
    }
    
    /*
     * @param $locality
     */
    public function setLocality($locality)
    {
        $this->_locality = $locality;
    }    

    /*
     * @var String
     */
    private $_shippingAddressTitle = null;
    
    /*
     * @return String
     */
    public function getShippingAddressTitle()
    {
        return $this->_shippingAddressTitle;
    }
    
    /*
     * @param $shippingAddressTitle
     */
    public function setShippingAddressTitle($shippingAddressTitle)
    {
        $this->_shippingAddressTitle = $shippingAddressTitle;
    }    

    /*
     * @var String
     */
    private $_shippingPostalCode = null;
    
    /*
     * @return String
     */
    public function getShippingPostalCode()
    {
        return $this->_shippingPostalCode;
    }
    
    /*
     * @param $shippingPostalCode
     */
    public function setShippingPostalCode($shippingPostalCode)
    {
        $this->_shippingPostalCode = $shippingPostalCode;
    }    

    /*
     * @var String
     */
    private $_shippingCity = null;
    
    /*
     * @return String
     */
    public function getShippingCity()
    {
        return $this->_shippingCity;
    }
    
    /*
     * @param $_shippingCity
     */
    public function setShippingCity($shippingCity)
    {
        $this->_shippingCity = $shippingCity;
    }    

    /*
     * @var String
     */
    private $_shippingCountry = null;
    
    /*
     * @return String
     */
    public function getShippingCountry()
    {
        return $this->_shippingCountry;
    }
    
    /*
     * @param $ShippingCountry
     */
    public function setShippingCountry($shippingCountry)
    {
        $this->_shippingCountry = $shippingCountry;
    }    

    /*
     * @var String
     */
    private $_landLinePhoneNumber = null;
    
    /*
     * @return String
     */
    public function getLandLinePhoneNumber()
    {
        return $this->_landLinePhoneNumber;
    }
    
    /*
     * @param $landLinePhoneNumber
     */
    public function setLandLinePhoneNumber($landLinePhoneNumber)
    {
        $this->_landLinePhoneNumber = $landLinePhoneNumber;
    }    

    /*
     * @var String
     */
    private $_cellPhoneNumber = null;
    
    /*
     * @return String
     */
    public function getCellPhoneNumber()
    {
        return $this->_cellPhoneNumber;
    }
    
    /*
     * @param $cellPhoneNumber
     */
    public function setCellPhoneNumber($cellPhoneNumber)
    {
        $this->_cellPhoneNumber = $cellPhoneNumber;
    }    
}