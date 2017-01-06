<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 17:35
 */

namespace Sdk\Customer;


class Customer
{
    /**
     * @var string
     */
    private $_civility = null;

    /**
     * @return string
     */
    public function getCivility()
    {
        return $this->_civility;
    }

    /**
     * @param string $civility
     */
    public function setCivility($civility)
    {
        $this->_civility = $civility;
    }

    /**
     * @var string
     */
    private $_customerId = null;

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->_customerId;
    }

    /**
     * @var string
     */
    private $_email = null;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @var string
     */
    private $_encryptedEmail = null;

    /**
     * @return string
     */
    public function getEncryptedEmail()
    {
        return $this->_encryptedEmail;
    }

    /**
     * @param string $encryptedEmail
     */
    public function setEncryptedEmail($encryptedEmail)
    {
        $this->_encryptedEmail = $encryptedEmail;
    }

    /**
     * @var string
     */
    private $_firstName = null;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->_firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->_firstName = $firstName;
    }

    /**
     * @var string
     */
    private $_lastName = null;

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    /**
     * @var string
     */
    private $_mobilePhone = null;

    /**
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->_mobilePhone;
    }

    /**
     * @param string $mobilePhone
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->_mobilePhone = $mobilePhone;
    }

    /**
     * @var string
     */
    private $_phone = null;

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @var string
     */
    private $_shippingFirstName = null;

    /**
     * @return string
     */
    public function getShippingFirstName()
    {
        return $this->_shippingFirstName;
    }

    /**
     * @param string $shippingFirstName
     */
    public function setShippingFirstName($shippingFirstName)
    {
        $this->_shippingFirstName = $shippingFirstName;
    }

    /**
     * @var string
     */
    private $_shippingLastName = null;

    /**
     * @return string
     */
    public function getShippingLastName()
    {
        return $this->_shippingLastName;
    }

    /**
     * @param string $shippingLastName
     */
    public function setShippingLastName($shippingLastName)
    {
        $this->_shippingLastName = $shippingLastName;
    }

    /**
     * @var string
     */
    private $_secondPhone = null;

    /**
     * @return string
     */
    public function getSecondPhone()
    {
        return $this->_secondPhone;
    }

    /**
     * @param string $secondPhone
     */
    public function setSecondPhone($secondPhone)
    {
        $this->_secondPhone = $secondPhone;
    }

    /**
     * Customer constructor.
     * @param $customerId string
     */
    public function __construct($customerId)
    {
        $this->_customerId = $customerId;
    }
}