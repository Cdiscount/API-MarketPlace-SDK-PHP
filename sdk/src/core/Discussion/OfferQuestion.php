<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 10:51
 */

namespace Sdk\Discussion;


use Sdk\Soap\Common\SoapTools;

class OfferQuestion extends GenericQuestion
{

    /**
     * @var string
     */
    private $_productEAN = null;

    /**
     * @return string
     */
    public function getProductEAN()
    {
        return $this->_productEAN;
    }

    /**
     * @param string $productEAN
     */
    public function setProductEAN($productEAN)
    {
        if (!SoapTools::isSoapValueNull($productEAN)) {
            $this->_productEAN = $productEAN;
        }
    }

    /**
     * @var string
     */
    private $_productSellerReference = null;

    /**
     * @return string
     */
    public function getProductSellerReference()
    {
        return $this->_productSellerReference;
    }

    /**
     * @param string $productSellerReference
     */
    public function setProductSellerReference($productSellerReference)
    {
        if (!SoapTools::isSoapValueNull($productSellerReference)) {
            $this->_productSellerReference = $productSellerReference;
        }
    }
}