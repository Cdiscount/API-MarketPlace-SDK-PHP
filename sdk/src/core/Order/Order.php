<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 13/10/2016
 * Time: 16:52
 */

namespace Sdk\Order;


class Order
{
    /**
     * Order constructor.
     * @param $orderNumber string
     */
    public function __construct($orderNumber)
    {
        $this->_orderNumber = $orderNumber;
    }

    /**
     * @var string
     */
    private $_orderNumber = null;

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->_orderNumber;
    }

    /**
     * @var \Sdk\Seller\Address
     */
    private $_billingAddress = null;

    /**
     * @return \Sdk\Seller\Address
     */
    public function getBillingAddress()
    {
        return $this->_billingAddress;
    }

    /**
     * @param \Sdk\Seller\Address $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->_billingAddress = $billingAddress;
    }

    /**
     * @var \Sdk\Seller\Address
     */
    private $_shippingAddress = null;

    /**
     * @return \Sdk\Seller\Address
     */
    public function getShippingAddress()
    {
        return $this->_shippingAddress;
    }

    /**
     * @param \Sdk\Seller\Address $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->_shippingAddress = $shippingAddress;
    }

    /**
     * @var \Sdk\Order\Corporation
     */
    private $_corporation = null;

    /**
     * @return Corporation
     */
    public function getCorporation()
    {
        return $this->_corporation;
    }

    /**
     * @param Corporation $corporation
     */
    public function setCorporation($corporation)
    {
        $this->_corporation = $corporation;
    }

    /**
     * @var string
     */
    //TODO convert to Date Object
    private $_creationDate = null;

    /**
     * @return string
     */
    public function getCreationDate()
    {
        return $this->_creationDate;
    }

    /**
     * @param string $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->_creationDate = $creationDate;
    }

    /**
     * @var \Sdk\Customer\Customer
     */
    private $_customer = null;

    /**
     * @return \Sdk\Customer\Customer
     */
    public function getCustomer()
    {
        return $this->_customer;
    }

    /**
     * @param \Sdk\Customer\Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->_customer = $customer;
    }

    /**
     * @var bool
     */
    private $_hasClaims = false;

    /**
     * @return boolean
     */
    public function isHasClaims()
    {
        return $this->_hasClaims;
    }

    /**
     * @param boolean $hasClaims
     */
    public function setHasClaims($hasClaims)
    {
        $this->_hasClaims = $hasClaims;
    }

    /**
     * @var float
     */
    private $_initialTotalAmount = 0.0;

    /**
     * @return float
     */
    public function getInitialTotalAmount()
    {
        return $this->_initialTotalAmount;
    }

    /**
     * @param float $initialTotalAmount
     */
    public function setInitialTotalAmount($initialTotalAmount)
    {
        $this->_initialTotalAmount = $initialTotalAmount;
    }

    /**
     * @var float
     */
    private $_initialTotalShippingChargesAmount = 0.0;

    /**
     * @return float
     */
    public function getInitialTotalShippingChargesAmount()
    {
        return $this->_initialTotalShippingChargesAmount;
    }

    /**
     * @param float $initialTotalShippingChargesAmount
     */
    public function setInitialTotalShippingChargesAmount($initialTotalShippingChargesAmount)
    {
        $this->_initialTotalShippingChargesAmount = $initialTotalShippingChargesAmount;
    }

    /**
     * @var bool
     */
    private $_isCLogistiqueOrder = false;

    /**
     * @return boolean
     */
    public function isIsCLogistiqueOrder()
    {
        return $this->_isCLogistiqueOrder;
    }

    /**
     * @param boolean $isCLogistiqueOrder
     */
    public function setIsCLogistiqueOrder($isCLogistiqueOrder)
    {
        $this->_isCLogistiqueOrder = $isCLogistiqueOrder;
    }

    /**
     * @var string
     */
    //TODO passer en vraie date
    private $_lastUpdatedDate = null;

    /**
     * @return string
     */
    public function getLastUpdatedDate()
    {
        return $this->_lastUpdatedDate;
    }

    /**
     * @param string $lastUpdatedDate
     */
    public function setLastUpdatedDate($lastUpdatedDate)
    {
        $this->_lastUpdatedDate = $lastUpdatedDate;
    }

    /**
     * @var string
     */
    //TODO passer en vraie date
    private $_modifiedDate = null;

    /**
     * @return string
     */
    public function getModifiedDate()
    {
        return $this->_modifiedDate;
    }

    /**
     * @param string $modifiedDate
     */
    public function setModifiedDate($modifiedDate)
    {
        $this->_modifiedDate = $modifiedDate;
    }

    /**
     * @var \Sdk\Order\OrderLineList
     */
    private $_orderLineList = null;

    /**
     * @return OrderLineList
     */
    public function getOrderLineList()
    {
        return $this->_orderLineList;
    }

    /**
     * @param OrderLineList $orderLineList
     */
    public function setOrderLineList($orderLineList)
    {
        $this->_orderLineList = $orderLineList;
    }

    /**
     * @var string
     */
    private $_shippingCode = null;

    /**
     * @return string
     */
    public function getShippingCode()
    {
        return $this->_shippingCode;
    }

    /**
     * @param string $shippingCode
     */
    public function setShippingCode($shippingCode)
    {
        $this->_shippingCode = $shippingCode;
    }

    #region SiteCommission

    /**
     * @var int
     */
    private $_siteCommissionPromisedAmount = 0;

    /**
     * @return int
     */
    public function getSiteCommissionPromisedAmount()
    {
        return $this->_siteCommissionPromisedAmount;
    }

    /**
     * @param int $siteCommissionPromisedAmount
     */
    public function setSiteCommissionPromisedAmount($siteCommissionPromisedAmount)
    {
        $this->_siteCommissionPromisedAmount = $siteCommissionPromisedAmount;
    }

    /**
     * @var int
     */
    private $_siteCommissionShippedAmount = 0;

    /**
     * @return int
     */
    public function getSiteCommissionShippedAmount()
    {
        return $this->_siteCommissionShippedAmount;
    }

    /**
     * @param int $siteCommissionShippedAmount
     */
    public function setSiteCommissionShippedAmount($siteCommissionShippedAmount)
    {
        $this->_siteCommissionShippedAmount = $siteCommissionShippedAmount;
    }

    /**
     * @var int
     */
    private $_siteCommissionValidatedAmount = 0;

    /**
     * @return int
     */
    public function getSiteCommissionValidatedAmount()
    {
        return $this->_siteCommissionValidatedAmount;
    }

    /**
     * @param int $siteCommissionValidatedAmount
     */
    public function setSiteCommissionValidatedAmount($siteCommissionValidatedAmount)
    {
        $this->_siteCommissionValidatedAmount = $siteCommissionValidatedAmount;
    }

    #endregion

    #region Status

    /**
     * @var \Sdk\Order\OrderStatusEnum
     */
    private $_status = OrderStatusEnum::None;

    /**
     * @return OrderStatusEnum
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param OrderStatusEnum $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @var \Sdk\Order\OrderStateEnum
     */
    private $_orderState = null;

    /**
     * @return string OrderStateEnum
     */
    public function getOrderState()
    {
        return $this->_orderState;
    }

    /**
     * @param string $orderState
     */
    public function setOrderState($orderState)
    {
        $this->_orderState = $orderState;
    }

    /**
     * @var \Sdk\Order\ValidationStatusEnum
     */
    private $_validationStatus = ValidationStatusEnum::None;

    /**
     * @return ValidationStatusEnum
     */
    public function getValidationStatus()
    {
        return $this->_validationStatus;
    }

    /**
     * @param ValidationStatusEnum $validationStatus
     */
    public function setValidationStatus($validationStatus)
    {
        $this->_validationStatus = $validationStatus;
    }

    #endregion Status

    #region Amount and Shipping Charges

    /**
     * @var int
     */
    private $_shippedTotalAmount = 0;

    /**
     * @return int
     */
    public function getShippedTotalAmount()
    {
        return $this->_shippedTotalAmount;
    }

    /**
     * @param int $shippedTotalAmount
     */
    public function setShippedTotalAmount($shippedTotalAmount)
    {
        $this->_shippedTotalAmount = $shippedTotalAmount;
    }

    /**
     * @var int
     */
    private $_shippedTotalShippingCharges = 0;

    /**
     * @return int
     */
    public function getShippedTotalShippingCharges()
    {
        return $this->_shippedTotalShippingCharges;
    }

    /**
     * @param int $shippedTotalShippingCharges
     */
    public function setShippedTotalShippingCharges($shippedTotalShippingCharges)
    {
        $this->_shippedTotalShippingCharges = $shippedTotalShippingCharges;
    }

    /**
     * @var int
     */
    private $_validatedTotalAmount = 0;

    /**
     * @return int
     */
    public function getValidatedTotalAmount()
    {
        return $this->_validatedTotalAmount;
    }

    /**
     * @param int $validatedTotalAmount
     */
    public function setValidatedTotalAmount($validatedTotalAmount)
    {
        $this->_validatedTotalAmount = $validatedTotalAmount;
    }

    /**
     * @var int
     */
    private $_validatedTotalShippingCharges = 0;

    /**
     * @return int
     */
    public function getValidatedTotalShippingCharges()
    {
        return $this->_validatedTotalShippingCharges;
    }

    /**
     * @param int $validatedTotalShippingCharges
     */
    public function setValidatedTotalShippingCharges($validatedTotalShippingCharges)
    {
        $this->_validatedTotalShippingCharges = $validatedTotalShippingCharges;
    }

    #endregion Amount and Shipping Charges

    /**
     * @var int
     */
    private $_visaCegid = 0;

    /**
     * @return int
     */
    public function getVisaCegid()
    {
        return $this->_visaCegid;
    }

    /**
     * @param int $visaCegid
     */
    public function setVisaCegid($visaCegid)
    {
        $this->_visaCegid = $visaCegid;
    }

    #region ParcelList

    /**
     * @var bool
     */
    private $_archiveParcelList = false;

    /**
     * @return boolean
     */
    public function isArchiveParcelList()
    {
        return $this->_archiveParcelList;
    }

    /**
     * @param boolean $archiveParcelList
     */
    public function setArchiveParcelList($archiveParcelList)
    {
        $this->_archiveParcelList = $archiveParcelList;
    }

    /**
     * @var \Sdk\Parcel\ParcelList
     */
    private $_parcelList = null;

    /**
     * @param $parcelList
     */
    public function setParcelList($parcelList)
    {
        $this->_parcelList = $parcelList;
    }

    /**
     * @return \Sdk\Parcel\ParcelList
     */
    public function getParcelList()
    {
        return $this->_parcelList;
    }

    #endregion ParcelList
}