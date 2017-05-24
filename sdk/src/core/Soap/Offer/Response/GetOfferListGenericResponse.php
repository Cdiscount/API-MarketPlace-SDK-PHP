<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 08/11/2016
 * Time: 10:18
 */

namespace Sdk\Soap\Offer\Response;


use Sdk\Delivey\DeliveryMode;
use Sdk\Delivey\ShippingInformation;
use Sdk\Offer\Offer;
use Sdk\Offer\OfferBenchMark;
use Sdk\Offer\OfferPool;
use Sdk\Soap\Common\iResponse;

class GetOfferListGenericResponse extends iResponse
{
    /**
     * @var array
     */
    private $_offerList = null;

    /**
     * @return array
     */
    public function getOfferList()
    {
        return $this->_offerList;
    }

    /**
     * @var array
     */
    protected $_dataResponse = null;

    /**
     * GetOfferListGenericResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);
        $this->_offerList = array();
    }

    /**
     * @param $offerList
     */
    protected function _setOfferListFromXML($offerList)
    {
        foreach ($offerList['Offer'] as $offerXML) {

            $offer = new Offer();

            $offer->setBestShippingCharges($offerXML['BestShippingCharges']);
            $offer->setComments($offerXML['Comments']);
            $offer->setCreationDate($offerXML['CreationDate']);
            $offer->setDeaTax($offerXML['DeaTax']);
            $offer->setDiscountList($offerXML['DiscountList']);
            $offer->setEcoTax($offerXML['EcoTax']);
            $offer->setIntegrationPrice($offerXML['IntegrationPrice']);
            if ($offerXML['IntegrationPrice'] == 'true') {
                $offer->setIsCDAV(true);
            }
            $offer->setLastUpdateDate($offerXML['LastUpdateDate']);
            $offer->setMinimumPriceForPriceAlignment($offerXML['MinimumPriceForPriceAlignment']);

            if (isset($offerXML['OfferBenchMark']['BestOfferPrice'])) {

                $offerBenchMark = new OfferBenchMark();
                $offerBenchMark->setBestOfferPrice(floatval($offerXML['OfferBenchMark']['BestOfferPrice']));

                if (isset($offerXML['OfferBenchMark']['ProductCondition'])) {
                    $offerBenchMark->setProductCondition($offerXML['OfferBenchMark']['ProductCondition']);
                }
                if (isset($offerXML['OfferBenchMark']['ProductState'])) {
                    $offerBenchMark->setProductState($offerXML['OfferBenchMark']['ProductState']);
                }
                if (isset($offerXML['OfferBenchMark']['ShippingCharges'])) {
                    $offerBenchMark->setShippingCharges(floatval($offerXML['OfferBenchMark']['ShippingCharges']));
                }
                $offer->setOfferBenchMark($offerBenchMark);
            }

            /** OfferPool */
            if (isset($offerXML['OfferPoolList']['OfferPool'])) {
                $offerPool = new OfferPool($offerXML['OfferPoolList']['OfferPool']['Id'], $offerXML['OfferPoolList']['OfferPool']['Description']);
                $offer->addOfferPool($offerPool);
            }
            $offer->setParentProductId($offerXML['ParentProductId']);
            $offer->setPrice($offerXML['Price']);
            $offer->setPriceMustBeAligned($offerXML['PriceMustBeAligned']);
            $offer->setProductCondition($offerXML['ProductCondition']);
            $offer->setProductEan($offerXML['ProductEan']);
            $offer->setProductId($offerXML['ProductId']);
            $offer->setProductPackagingUnit($offerXML['ProductPackagingUnit']);
            $offer->setProductPackagingUnitPrice($offerXML['ProductPackagingUnitPrice']);
            $offer->setProductPackagingValue($offerXML['ProductPackagingValue']);
            $offer->setSellerProductId($offerXML['SellerProductId']);

            /** ShippingInfo */
            if (isset($offerXML['ShippingInformationList']) && isset($offerXML['ShippingInformationList']['ShippingInformation'])) {
                foreach ($offerXML['ShippingInformationList']['ShippingInformation'] as $shippingInfoXML) {

                    $shippingInfo = new ShippingInformation();
                    $shippingInfo->setAdditionalShippingCharges($shippingInfoXML['AdditionalShippingCharges']);

                    /** @var DeliveryMode $deliveryMode */
                    $deliveryMode = new DeliveryMode();
                    $deliveryMode->setCode($shippingInfoXML['DeliveryMode']['Code']);
                    $deliveryMode->setCode($shippingInfoXML['DeliveryMode']['Name']);
                    $shippingInfo->setDeliveryMode($deliveryMode);

                    $shippingInfo->setMaxLeadTime($shippingInfoXML['MaxLeadTime']);
                    $shippingInfo->setMinLeadTime($shippingInfoXML['MinLeadTime']);
                    $shippingInfo->setShippingCharges($shippingInfoXML['ShippingCharges']);

                    $offer->addShippingInformation($shippingInfo);
                }
            }

            $offer->setStock($offerXML['Stock']);
            $offer->setStrikedPrice($offerXML['StrikedPrice']);
            $offer->setVatRate($offerXML['VatRate']);

            array_push($this->_offerList, $offer);
        }
    }
}
