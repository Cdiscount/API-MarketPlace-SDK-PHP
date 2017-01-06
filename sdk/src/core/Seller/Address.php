<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 09:45
 */

namespace Sdk\Seller;


use Sdk\Soap\Common\SoapTools;

class Address
{

    private $_address1 = null;

    /**
     * @return null
     */
    public function getAddress1()
    {
        return $this->_address1;
    }

    /**
     * @param null $address1
     */
    public function setAddress1($address1)
    {
        if (!SoapTools::isSoapValueNull($address1)) {
            $this->_address1 = $address1;
        }
    }

    private $_address2 = null;

    /**
     * @return null
     */
    public function getAddress2()
    {
        return $this->_address2;
    }

    /**
     * @param null $address2
     */
    public function setAddress2($address2)
    {
        if (!SoapTools::isSoapValueNull($address2)) {
            $this->_address2 = $address2;
        }
    }

    private $_apartmentNumber = null;

    /**
     * @return null
     */
    public function getApartmentNumber()
    {
        return $this->_apartmentNumber;
    }

    /**
     * @param null $apartmentNumber
     */
    public function setApartmentNumber($apartmentNumber)
    {
        if (!SoapTools::isSoapValueNull($apartmentNumber)) {
            $this->_apartmentNumber = $apartmentNumber;
        }
    }

    private $_building = null;

    /**
     * @return null
     */
    public function getBuilding()
    {
        return $this->_building;
    }

    /**
     * @param null $building
     */
    public function setBuilding($building)
    {
        if (!SoapTools::isSoapValueNull($building)) {
            $this->_building = $building;
        }
    }

    private $_city = null;

    /**
     * @return null
     */
    public function getCity()
    {
        return $this->_city;
    }

    /**
     * @param null $city
     */
    public function setCity($city)
    {
        if (!SoapTools::isSoapValueNull($city)) {
            $this->_city = $city;
        }
    }

    /**
     * @var null
     */
    private $_civility = null;

    /**
     * @return null
     */
    public function getCivility()
    {
        return $this->_civility;
    }

    /**
     * @param null $civility
     */
    public function setCivility($civility)
    {
        if (!SoapTools::isSoapValueNull($civility)) {
            $this->_civility = $civility;
        }
    }

    private $_companyName = null;

    /**
     * @return null
     */
    public function getCompanyName()
    {
        return $this->_companyName;
    }

    /**
     * @param null $companyName
     */
    public function setCompanyName($companyName)
    {
        if (!SoapTools::isSoapValueNull($companyName)) {
            $this->_companyName = $companyName;
        }
    }

    private $_country = null;

    /**
     * @return null
     */
    public function getCountry()
    {
        return $this->_country;
    }

    /**
     * @param null $country
     */
    public function setCountry($country)
    {
        if (!SoapTools::isSoapValueNull($country)) {
            $this->_country = $country;
        }
    }

    private $_county = null;

    /**
     * @return null
     */
    public function getCounty()
    {
        return $this->_county;
    }

    /**
     * @param null $county
     */
    public function setCounty($county)
    {
        if (!SoapTools::isSoapValueNull($county)) {
            $this->_county = $county;
        }
    }

    private $_firstName = null;

    /**
     * @return null
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param null $firstName
     */
    public function setFirstName($firstName)
    {
        if (!SoapTools::isSoapValueNull($firstName)) {
            $this->_firstName = $firstName;
        }
    }

    private $_instructions = null;

    /**
     * @return null
     */
    public function getInstructions()
    {
        return $this->_instructions;
    }

    /**
     * @param null $instructions
     */
    public function setInstructions($instructions)
    {
        if (!SoapTools::isSoapValueNull($instructions)) {
            $this->_instructions = $instructions;
        }
    }

    private $_lastName = null;

    /**
     * @return null
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param null $lastName
     */
    public function setLastName($lastName)
    {
        if (!SoapTools::isSoapValueNull($lastName)) {
            $this->_lastName = $lastName;
        }
    }

    private $_placeName = null;

    /**
     * @return null
     */
    public function getPlaceName()
    {
        return $this->_placeName;
    }

    /**
     * @param null $placeName
     */
    public function setPlaceName($placeName)
    {
        if (!SoapTools::isSoapValueNull($placeName)) {
            $this->_placeName = $placeName;
        }
    }

    private $_relayId = null;

    /**
     * @return null
     */
    public function getRelayId()
    {
        return $this->_relayId;
    }

    /**
     * @param null $relayId
     */
    public function setRelayId($relayId)
    {
        if (!SoapTools::isSoapValueNull($relayId)) {
            $this->_relayId = $relayId;
        }
    }

    private $_street = null;

    /**
     * @return null
     */
    public function getStreet()
    {
        return $this->_street;
    }

    /**
     * @param null $street
     */
    public function setStreet($street)
    {
        if (!SoapTools::isSoapValueNull($street)) {
            $this->_street = $street;
        }
    }

    private $_zipCode = null;

    /**
     * @return null
     */
    public function getZipCode()
    {
        return $this->_zipCode;
    }

    /**
     * @param null $zipCode
     */
    public function setZipCode($zipCode)
    {
        if (!SoapTools::isSoapValueNull($zipCode)) {
            $this->_zipCode = $zipCode;
        }
    }
}