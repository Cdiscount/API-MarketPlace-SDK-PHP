<?php
/**
 * Created by El Ibaoui Otmane (SQLI)
 * Date: 5/05/2017
 * Time: 16:08
 */

namespace Sdk\Fulfilment;

/**
 * External Order
 */
class ExternalOrder
{

    /**
     * @var ExternalCustomer
     */
    private $_externalCustomer = null;

    /**
     * @return ExternalCustomer
     */
    public function getExternalCustomer()
    {
        return $this->_externalCustomer;
    }

    /**
     * @param ExternalCustomer $externalCustomer
     */
    public function setExternalCustomer($externalCustomer)
    {
        $this->_externalCustomer = $externalCustomer;
    }

    /**
     * @var array ExternalOrderLine
     */
    private $_externalOrderLine = array();

    /**
     * @return array ExternalOrderLine
     */
    public function getExternalOrderLine()
    {
        return $this->_externalOrderLine;
    }

    /**
     * @param array ExternalOrderLine 
     */
    public function setExternalOrderLine($externalOrderLine)
    {
        array_push($this->_externalOrderLine, $externalOrderLine);
    }

    /**
     * @function addExternalOrderLine() ExternalOrderLine
     */
    public function addExternalOrderLine($orderLine)
    {
        $object = new ExternalOrderLine();
        $object->setProductEan($orderLine->getProductEan());
        $object->setProductReference($orderLine->getProductReference());
        $object->setQuantity($orderLine->getQuantity());
        $_externalOrderLine[] = $object;
    }

    /*
     * @var Int
     */
    private $_customerOrderNumber = null;
    
    /*
     * @return Int
     */
    public function getCustomerOrderNumber()
    {
        return $this->_customerOrderNumber;
    }
    
    /*
     * @param $customerOrderNumber
     */
    public function setCustomerOrderNumber($customerOrderNumber)
    {
        $this->_customerOrderNumber = $customerOrderNumber;
    }    

    /*
     * @var String
     */
    private $_corporation = null;
    
    /*
     * @return String
     */
    public function getCorporation()
    {
        return $this->_corporation;
    }
    
    /*
     * @param $corporation
     */
    public function setCorporation($corporation)
    {
        $this->_corporation = $corporation;
    }    

    /*
     * @var String
     */
    private $_comments = null;
    
    /*
     * @return String
     */
    public function getComments()
    {
        return $this->_comments;
    }
    
    /*
     * @param $comments
     */
    public function setComments($comments)
    {
        $this->_comments = $comments;
    }    

    /*
     * @var string 
     */
    private $_orderDate = null;
    
    /*
     * @return string 
     */
    public function getOrderDate()
    {
        return $this->_orderDate;
    }
    
    /*
     * @param $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->_orderDate = $orderDate;
    }    

    /*
     * @var String
     */
    private $_shippingMode = null;
    
    /*
     * @return String
     */
    public function getShippingMode()
    {
        return $this->_shippingMode;
    }
    
    /*
     * @param $shippingMode
     */
    public function setShippingMode($shippingMode)
    {
        $this->_shippingMode = $shippingMode;
    }    

    /*
     * @var Long
     */
    private $_sellerId = null;
    
    /*
     * @return String
     */
    public function getSellerId()
    {
        return $this->_sellerId;
    }
    
    /*
     * @param $sellerId
     */
    public function setSellerId($sellerId)
    {
        $this->_sellerId = $sellerId;
    }    

    /*
     * @var String
     */
    private $_shippingCode = null;
    
    /*
     * @return String
     */
    public function getShippingCode()
    {
        return $this->_shippingCode;
    }
    
    /*
     * @param $shippingCode
     */
    public function setShippingCode($shippingCode)
    {
        $this->_shippingCode = $shippingCode;
    }    

    /*
     * @var String
     */
    private $_siteConfigurationId = null;
    
    /*
     * @return String
     */
    public function getSiteConfigurationId()
    {
        return $this->_siteConfigurationId;
    }
    
    /*
     * @param $siteConfigurationId
     */
    public function setSiteConfigurationId($siteConfigurationId)
    {
        $this->_siteConfigurationId = $siteConfigurationId;
    }    

    /*
     * @var String
     */
    private $_sellerEmail = null;
    
    /*
     * @return String
     */
    public function getSellerEmail()
    {
        return $this->_sellerEmail;
    }
    
    /*
     * @param $sellerEmail
     */
    public function setSellerEmail($sellerEmail)
    {
        $this->_sellerEmail = $sellerEmail;
    }    

    /*
     * @var String
     */
    private $_siteId = null;
    
    /*
     * @return String
     */
    public function getSiteId()
    {
        return $this->_siteId;
    }
    
    /*
     * @param $siteId
     */
    public function setSiteId($siteId)
    {
        $this->_siteId = $siteId;
    }    
}