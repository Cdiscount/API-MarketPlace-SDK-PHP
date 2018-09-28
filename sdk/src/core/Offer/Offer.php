<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 07/11/2016
 * Time: 11:47
 */

namespace Sdk\Offer;


use Sdk\Soap\Common\SoapTools;

class Offer
{

    /**
     * @var float
     */
    private $_bestShippingCharges = 0.0;

    /**
     * @return float
     */
    public function getBestShippingCharges()
    {
        return $this->_bestShippingCharges;
    }

    /**
     * @param float $bestShippingCharges
     */
    public function setBestShippingCharges($bestShippingCharges)
    {
        if (!SoapTools::isSoapValueNull($bestShippingCharges)) {
            $this->_bestShippingCharges = $bestShippingCharges;
        }
    }

    /**
     * @var string
     */
    private $_comments = null;

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->_comments;
    }

    /**
     * @param string $comments
     */
    public function setComments($comments)
    {
        if (!SoapTools::isSoapValueNull($comments)) {
            $this->_comments = $comments;
        }
    }

    /**
     * @var string
     */
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
        if (!SoapTools::isSoapValueNull($creationDate)) {
            $this->_creationDate = $creationDate;
        }
    }

    /**
     * @var float
     */
    private $_deaTax = 0.0;

    /**
     * @return float
     */
    public function getDeaTax()
    {
        return $this->_deaTax;
    }

    /**
     * @param float $deaTax
     */
    public function setDeaTax($deaTax)
    {
        if (!SoapTools::isSoapValueNull($deaTax)) {
            $this->_deaTax = $deaTax;
        }
    }

    /**
     * @var string
     */
    private $_discountList = null;

    /**
     * @return string
     */
    public function getDiscountList()
    {
        return $this->_discountList;
    }

    /**
     * @param string $discountList
     */
    public function setDiscountList($discountList)
    {
        if (!SoapTools::isSoapValueNull($discountList)) {
            $this->_discountList = $discountList;
        }
    }

    /**
     * @var float
     */
    private $_ecoTax = 0.0;

    /**
     * @return float
     */
    public function getEcoTax()
    {
        return $this->_ecoTax;
    }

    /**
     * @param float $ecoTax
     */
    public function setEcoTax($ecoTax)
    {
        if (!SoapTools::isSoapValueNull($ecoTax)) {
            $this->_ecoTax = $ecoTax;
        }
    }

    /**
     * @var float
     */
    private $_integrationPrice = 0.0;

    /**
     * @return float
     */
    public function getIntegrationPrice()
    {
        return $this->_integrationPrice;
    }

    /**
     * @param float $integrationPrice
     */
    public function setIntegrationPrice($integrationPrice)
    {
        if (!SoapTools::isSoapValueNull($integrationPrice)) {
            $this->_integrationPrice = $integrationPrice;
        }
    }

    /**
     * @var bool
     */
    private $_isCDAV = false;

    /**
     * @return boolean
     */
    public function isIsCDAV()
    {
        return $this->_isCDAV;
    }

    /**
     * @param boolean $isCDAV
     */
    public function setIsCDAV($isCDAV)
    {
        $this->_isCDAV = $isCDAV;
    }

    /**
     * @var string
     */
    private $_lastUpdateDate = null;

    /**
     * @return string
     */
    public function getLastUpdateDate()
    {
        return $this->_lastUpdateDate;
    }

    /**
     * @param string $lastUpdateDate
     */
    public function setLastUpdateDate($lastUpdateDate)
    {
        if (!SoapTools::isSoapValueNull($lastUpdateDate)) {
            $this->_lastUpdateDate = $lastUpdateDate;
        }
    }

    /**
     * @var string
     */
    private $_logisticMode = null;

    /**
     * @return string
     */
    public function getLogisticMode()
    {
        return $this->_logisticMode;
    }

    /**
     * @param string $logisticMode
     */
    public function setLogisticMode($logisticMode)
    {
        if (!SoapTools::isSoapValueNull($logisticMode)) {
            $this->_logisticMode = $logisticMode;
        }
    }

    /**
     * @var float
     */
    private $_minimumPriceForPriceAlignment = 0.0;

    /**
     * @return float
     */
    public function getMinimumPriceForPriceAlignment()
    {
        return $this->_minimumPriceForPriceAlignment;
    }

    /**
     * @param float $minimumPriceForPriceAlignment
     */
    public function setMinimumPriceForPriceAlignment($minimumPriceForPriceAlignment)
    {
        if (!SoapTools::isSoapValueNull($minimumPriceForPriceAlignment)) {
            $this->_minimumPriceForPriceAlignment = $minimumPriceForPriceAlignment;
        }
    }

    /**
     * @var \Sdk\Offer\OfferBenchMark
     */
    private $_offerBenchMark = null;

    /**
     * @return OfferBenchMark
     */
    public function getOfferBenchMark()
    {
        return $this->_offerBenchMark;
    }

    /**
     * @param \Sdk\Offer\OfferBenchMark $offerBenchMark
     */
    public function setOfferBenchMark($offerBenchMark)
    {
        $this->_offerBenchMark = $offerBenchMark;
    }

    /**
     * @var array
     */
    private $_offerPoolList = null;

    /**
     * @return array
     */
    public function getOfferPoolList()
    {
        return $this->_offerPoolList;
    }

    /**
     * @param $offerPool \Sdk\Offer\OfferPool
     */
    public function addOfferPool($offerPool)
    {
        if ($this->_offerPoolList == null) {
            $this->_offerPoolList = array();
        }
        array_push($this->_offerPoolList, $offerPool);
    }

    /**
     * @var string
     */
    private $_offerState = null;

    /**
     * @return string
     */
    public function getOfferState()
    {
        return $this->_offerState;
    }

    /**
     * @param string $offerState
     */
    public function setOfferState($offerState)
    {
        if (!SoapTools::isSoapValueNull($offerState)) {
            $this->_offerState = $offerState;
        }
    }

    /**
     * @var string
     */
    private $_parentProductId = null;

    /**
     * @return string
     */
    public function getParentProductId()
    {
        return $this->_parentProductId;
    }

    /**
     * @param string $parentProductId
     */
    public function setParentProductId($parentProductId)
    {
        if (!SoapTools::isSoapValueNull($parentProductId)) {
            $this->_parentProductId = $parentProductId;
        }
    }

    /**
     * @var float
     */
    private $_price = 0.0;

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        if (!SoapTools::isSoapValueNull($price)) {
            $this->_price = $price;
        }
    }

    /**
     * @var string
     */
    private $_priceMustBeAligned = null;

    /**
     * @return string
     */
    public function getPriceMustBeAligned()
    {
        return $this->_priceMustBeAligned;
    }

    /**
     * @param string $priceMustBeAligned
     */
    public function setPriceMustBeAligned($priceMustBeAligned)
    {
        if (!SoapTools::isSoapValueNull($priceMustBeAligned)) {
            $this->_priceMustBeAligned = $priceMustBeAligned;
        }
    }

    /**
     * @var string
     */
    private $_productCondition = null;

    /**
     * @return string
     */
    public function getProductCondition()
    {
        return $this->_productCondition;
    }

    /**
     * @param string $productCondition
     */
    public function setProductCondition($productCondition)
    {
        if (!SoapTools::isSoapValueNull($productCondition)) {
            $this->_productCondition = $productCondition;
        }
    }

    /**
     * @var string
     */
    private $_productEan = null;

    /**
     * @return string
     */
    public function getProductEan()
    {
        return $this->_productEan;
    }

    /**
     * @param string $productEan
     */
    public function setProductEan($productEan)
    {
        if (!SoapTools::isSoapValueNull($productEan)) {
            $this->_productEan = $productEan;
        }
    }

    /**
     * @var string
     */
    private $_productId = null;

    /**
     * @return string
     */
    public function getProductId()
    {
        return $this->_productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId($productId)
    {
        if (!SoapTools::isSoapValueNull($productId)) {
            $this->_productId = $productId;
        }
    }

    /**
     * @var string
     */
    private $_productPackagingUnit = null;

    /**
     * @return string
     */
    public function getProductPackagingUnit()
    {
        return $this->_productPackagingUnit;
    }

    /**
     * @param string $productPackagingUnit
     */
    public function setProductPackagingUnit($productPackagingUnit)
    {
        if (!SoapTools::isSoapValueNull($productPackagingUnit)) {
            $this->_productPackagingUnit = $productPackagingUnit;
        }
    }

    /**
     * @var float
     */
    private $_productPackagingUnitPrice = 0.0;

    /**
     * @return float
     */
    public function getProductPackagingUnitPrice()
    {
        return $this->_productPackagingUnitPrice;
    }

    /**
     * @param float $productPackagingUnitPrice
     */
    public function setProductPackagingUnitPrice($productPackagingUnitPrice)
    {
        if (!SoapTools::isSoapValueNull($productPackagingUnitPrice)) {
            $this->_productPackagingUnitPrice = $productPackagingUnitPrice;
        }
    }

    /**
     * @var float
     */
    private $_productPackagingValue = 0.0;

    /**
     * @return float
     */
    public function getProductPackagingValue()
    {
        return $this->_productPackagingValue;
    }

    /**
     * @param float $productPackagingValue
     */
    public function setProductPackagingValue($productPackagingValue)
    {
        if (!SoapTools::isSoapValueNull($productPackagingValue)) {
            $this->_productPackagingValue = $productPackagingValue;
        }
    }

    /**
     * @var string
     */
    private $_sellerProductId = null;

    /**
     * @return string
     */
    public function getSellerProductId()
    {
        return $this->_sellerProductId;
    }

    /**
     * @param string $sellerProductId
     */
    public function setSellerProductId($sellerProductId)
    {
        if (!SoapTools::isSoapValueNull($sellerProductId)) {
            $this->_sellerProductId = $sellerProductId;
        }
    }

    /**
     * @var array
     */
    private $_shippingInformationList = null;

    /**
     * @return array
     */
    public function getShippingInformationList()
    {
        return $this->_shippingInformationList;
    }

    /**
     * @param $shippingInformation \Sdk\Delivey\ShippingInformation
     */
    public function addShippingInformation($shippingInformation)
    {
        if ($this->_shippingInformationList == null) {
            $this->_shippingInformationList = array();
        }
        array_push($this->_shippingInformationList, $shippingInformation);
    }

    /**
     * @var int
     */
    private $_stock = 0;

    /**
     * @return int
     */
    public function getStock()
    {
        return $this->_stock;
    }

    /**
     * @param int $stock
     */
    public function setStock($stock)
    {
        if (!SoapTools::isSoapValueNull($stock)) {
            $this->_stock = $stock;
        }
    }

    /**
     * @var string
     */
    private $_strikedPrice = null;

    /**
     * @return string
     */
    public function getStrikedPrice()
    {
        return $this->_strikedPrice;
    }

    /**
     * @param string $strikedPrice
     */
    public function setStrikedPrice($strikedPrice)
    {
        if (!SoapTools::isSoapValueNull($strikedPrice)) {
            $this->_strikedPrice = $strikedPrice;
        }
    }

    /**
     * @var float
     */
    private $_vatRate = 0.0;

    /**
     * @return float
     */
    public function getVatRate()
    {
        return $this->_vatRate;
    }

    /**
     * @param float $vatRate
     */
    public function setVatRate($vatRate)
    {
        if (!SoapTools::isSoapValueNull($vatRate)) {
            $this->_vatRate = $vatRate;
        }
    }
}