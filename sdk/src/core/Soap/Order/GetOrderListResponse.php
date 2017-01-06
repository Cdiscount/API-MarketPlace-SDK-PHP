<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 15:36
 */

namespace Sdk\Soap\Order;


use Sdk\Customer\Customer;
use Sdk\Order\Corporation;
use Sdk\Order\Order;
use Sdk\Order\OrderLine;
use Sdk\Order\OrderLineList;
use Sdk\Order\OrderList;
use Sdk\Parcel\Parcel;
use Sdk\Parcel\ParcelItem;
use Sdk\Parcel\ParcelItemList;
use Sdk\Parcel\ParcelList;
use Sdk\Seller\Address;
use Sdk\Soap\Common\iResponse;

class GetOrderListResponse extends iResponse
{
    /**
     * @var array
     */
    private $_dataResponse;

    /**
     * @var \Sdk\Order\OrderList
     */
    private $_orderList = null;

    /**
     * @return \Sdk\Order\OrderList
     */
    public function getOrderList()
    {
        return $this->_orderList;
    }

    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check for error messages
        if (!$this->_hasErrorMessage()) {

            $this->_orderList = new OrderList();

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            /**
             * Order list
             */
            $this->_setOrderList();
        }
    }

    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetOrderListResponse']['GetOrderListResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetOrderListResponse']['GetOrderListResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }

    /**
     *
     */
    private function _setOrderList()
    {
        $objOrderResult = $this->_dataResponse['s:Body']['GetOrderListResponse']['GetOrderListResult']['OrderList'];

        $arrays = false;
        if (isset($objOrderResult['Order'])) {
            foreach ($objOrderResult['Order'] as $order) {

                if (is_array($order)) {
                    $orderObj = new Order($order['OrderNumber']);

                    if ($order['ArchiveParcelList'] == 'true') {
                        $orderObj->setArchiveParcelList(true);
                    }

                    $address = $this->_getAddress($order['BillingAddress']);
                    $orderObj->setBillingAddress($address);

                    $corporation = $this->_getCorporation($order['Corporation']);
                    $orderObj->setCorporation($corporation);

                    $orderObj->setCreationDate($order['CreationDate']);

                    $customer = $this->_getCustomer($order['Customer']);
                    $orderObj->setCustomer($customer);

                    if ($order['HasClaims'] == 'true') {
                        $orderObj->setHasClaims(true);
                    }

                    $orderObj->setInitialTotalAmount(floatval($order['InitialTotalAmount']));
                    $orderObj->setInitialTotalShippingChargesAmount(floatval($order['InitialTotalShippingChargesAmount']));

                    if ($order['IsCLogistiqueOrder'] == 'true') {
                        $orderObj->setIsCLogistiqueOrder(true);
                    }

                    $orderObj->setLastUpdatedDate($order['LastUpdatedDate']);
                    $orderObj->setModifiedDate($order['ModifiedDate']);

                    $orderLineList = $this->_getOrderLineList($order['OrderLineList']['OrderLine']);
                    $orderObj->setOrderLineList($orderLineList);

                    //TODO gérer offer

                    $orderObj->setOrderState($order['OrderState']);

                    $parcelList = $this->_getParcelList($order['ParcelList']);
                    $orderObj->setParcelList($parcelList);

                    $orderObj->setShippedTotalAmount(intval($order['ShippedTotalAmount']));

                    $orderObj->setShippedTotalShippingCharges(intval($order['ShippedTotalShippingCharges']));

                    $address = $this->_getAddress($order['ShippingAddress']);
                    $orderObj->setShippingAddress($address);

                    $orderObj->setSiteCommissionPromisedAmount(intval($order['SiteCommissionPromisedAmount']));
                    $orderObj->setSiteCommissionShippedAmount(intval($order['SiteCommissionShippedAmount']));
                    $orderObj->setSiteCommissionValidatedAmount(intval($order['SiteCommissionValidatedAmount']));

                    $orderObj->setStatus($order['Status']);

                    $orderObj->setValidatedTotalAmount(intval($order['ValidatedTotalAmount']));
                    $orderObj->setValidatedTotalShippingCharges(intval($order['ValidatedTotalShippingCharges']));

                    $orderObj->setValidationStatus($order['ValidationStatus']);

                    $orderObj->setVisaCegid(intval($order['VisaCegid']));

                    $this->_orderList->addOrder($orderObj);
                }
            }
        }

    }

    /**
     * Retrieve <BillingAddress> Balise
     *
     * @param $objAddressResult
     * @return Address
     */
    private function _getAddress($objAddressResult)
    {
        $address = new Address();

        $address->setAddress1($objAddressResult['Address1']);
        $address->setAddress2($objAddressResult['Address2']);
        $address->setApartmentNumber($objAddressResult['ApartmentNumber']);
        $address->setBuilding($objAddressResult['Building']);
        $address->setCity($objAddressResult['City']);
        $address->setCivility($objAddressResult['Civility']);
        $address->setCompanyName($objAddressResult['CompanyName']);
        $address->setCountry($objAddressResult['Country']);
        $address->setCounty($objAddressResult['County']);
        $address->setFirstName($objAddressResult['FirstName']);
        $address->setInstructions($objAddressResult['Instructions']);
        $address->setLastName($objAddressResult['LastName']);
        $address->setPlaceName($objAddressResult['PlaceName']);
        $address->setRelayId($objAddressResult['RelayId']);
        $address->setStreet($objAddressResult['Street']);
        $address->setZipCode($objAddressResult['ZipCode']);

        return $address;
    }

    /**
     * Retrieve <Corporation> Balise
     *
     * @param $objCorporation
     * @return Corporation
     */
    private function _getCorporation($objCorporation)
    {
        $corporation = new Corporation();

        $corporation->setBusinessUnitId(intval($objCorporation['BusinessUnitId']));
        $corporation->setCorporationCode($objCorporation['CorporationCode']);
        $corporation->setCorporationId(intval($objCorporation['CorporationId']));
        $corporation->setCorporationName($objCorporation['CorporationName']);

        if ($objCorporation['IsMarketPlaceActive'] == 'true') {
            $corporation->setIsMarketPlaceActive(true);
        }
        return $corporation;
    }

    /**
     * Retrieve <Corporation> Customer
     *
     * @param $objCustomer
     * @return Customer
     */
    private function _getCustomer($objCustomer)
    {
        $customer = new Customer($objCustomer['CustomerId']);
        $customer->setCivility($objCustomer['Civility']);
        $customer->setEmail($objCustomer['Email']);
        $customer->setEncryptedEmail($objCustomer['EncryptedEmail']);
        $customer->setFirstName($objCustomer['FirstName']);
        $customer->setLastName($objCustomer['LastName']);
        $customer->setMobilePhone($objCustomer['MobilePhone']);
        $customer->setPhone($objCustomer['Phone']);
        $customer->setShippingFirstName($objCustomer['ShippingFirstName']);
        $customer->setShippingLastName($objCustomer['ShippingLastName']);
        $customer->setSecondPhone($objCustomer['Phone']);

        return $customer;
    }

    /**
     * @param $orderLineListOBJ
     * @return OrderLineList
     */
    private function _getOrderLineList($orderLineListOBJ)
    {
        //TODO check multiple orderline
        $orderLine = new OrderLine($orderLineListOBJ['ProductId']);

        $orderLineList = new OrderLineList();

        $orderLine->setAcceptationState($orderLineListOBJ['AcceptationState']);
        $orderLine->setCategoryCode($orderLineListOBJ['CategoryCode']);

        /**
         * Delivery Dates
         */
        $orderLine->setDeliveryDateMax($orderLineListOBJ['DeliveryDateMax']);
        $orderLine->setDeliveryDateMin($orderLineListOBJ['DeliveryDateMin']);

        if ($orderLineListOBJ['HasClaim'] == 'true') {
            $orderLine->setHasClaim(true);
        }
        $orderLine->setInitialPrice($orderLineListOBJ['InitialPrice']);
        if ($orderLineListOBJ['IsCDAV'] == 'true') {
            $orderLine->setCdav(true);
        }
        if ($orderLineListOBJ['IsNegotiated'] == 'true') {
            $orderLine->setIsNegotiated(true);
        }
        if ($orderLineListOBJ['IsProductEanGenerated'] == 'true') {
            $orderLine->setProductEanGenerated(true);
        }
        $orderLine->setName($orderLineListOBJ['Name']);
        //TODO add orderlinechildlist

        $orderLine->setProductCondition($orderLineListOBJ['ProductCondition']);
        $orderLine->setProductEan($orderLineListOBJ['ProductEan']);
        $orderLine->setPurchasePrice(floatval($orderLineListOBJ['PurchasePrice']));
        $orderLine->setQuantity(intval($orderLineListOBJ['Quantity']));
        $orderLine->setRowId(intval($orderLineListOBJ['RowId']));
        $orderLine->setSellerProductId($orderLineListOBJ['SellerProductId']);
        $orderLine->setShippingDateMax($orderLineListOBJ['ShippingDateMax']);
        $orderLine->setShippingDateMin($orderLineListOBJ['ShippingDateMin']);
        $orderLine->setSku($orderLineListOBJ['Sku']);
        $orderLine->setSkuParent($orderLineListOBJ['SkuParent']);
        $orderLine->setUnitAdditionalShippingCharges(intval($orderLineListOBJ['UnitAdditionalShippingCharges']));
        $orderLine->setUnitShippingCharges(intval($orderLineListOBJ['UnitShippingCharges']));

        $orderLineList->addOrderLine($orderLine);

        return $orderLineList;
    }

    private function _getParcelList($parcelList)
    {
        $parcelListObj = new ParcelList();

        foreach ($parcelList as $parcel) {
            //echo "CustomerNum : " . $parcel['CustomerNum'] . "<br/>";

            $parcelObj = new Parcel();
            $parcelObj->setCustomerNum($parcel['CustomerNum']);
            $parcelObj->setExternalCarrierName($parcel['ExternalCarrierName']);
            $parcelObj->setExternalCarrierTrackingUrl($parcel['ExternalCarrierTrackingUrl']);
            if ($parcel['IsCustomerReturn'] == 'true') {
                $parcelObj->setCustomerReturn(true);
            }
            $parcelObj->setParcelStatus($parcel['ParcelStatus']);
            $parcelObj->setRealCarrierCode($parcel['RealCarrierCode']);

            foreach ($parcel['ParcelItemList'] as $parcelItem) {

                $parcelItemObj = new ParcelItem($parcelItem['Sku']);
                $parcelItemObj->setQuantity(intval($parcelItem['Quantity']));
                $parcelItemObj->setProductName($parcelItem['ProductName']);

                $parcelObj->getParcelItemList()->addParcelItem($parcelItemObj);
            }

            $parcelListObj->addParcel($parcelObj);
        }

        return $parcelListObj;
    }
}