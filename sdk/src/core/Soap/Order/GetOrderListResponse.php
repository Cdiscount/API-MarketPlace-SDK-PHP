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
use Sdk\Parcel\Tracking;
use Sdk\Parcel\TrackingList;
use Sdk\Seller\Address;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

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

    /**
     * GetOrderListResponse constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        if ($this->isOperationSuccess($this->_dataResponse['s:Body']['GetOrderListResponse']['GetOrderListResult']))
        {
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
     * Parse the list of orders
     */
    private function _setOrderList()
    {
        $objOrderResult = $this->_dataResponse['s:Body']['GetOrderListResponse']['GetOrderListResult']['OrderList'];
        
        $arrays = false;
        if (isset($objOrderResult['Order'])) {
            $orderResults = $objOrderResult['Order'];
            if (isset($orderResults['OrderNumber'])){
                $orderResults = array($orderResults);
            }
            foreach ($orderResults as $order) {

                if (is_array($order)) {
                    $orderObj = new Order($order['OrderNumber']);

                    if ($order['ArchiveParcelList'] == 'true') {
                        $orderObj->setArchiveParcelList(true);
                    }

                    $address = $this->_getAddress($order['BillingAddress']);
                    $orderObj->setBillingAddress($address);

                    if (!SoapTools::isSoapValueNull($order['Corporation'])) {
                        $corporation = $this->_getCorporation($order['Corporation']);
                        $orderObj->setCorporation($corporation);
                    }

                    $orderObj->setCreationDate($order['CreationDate']);

                    $customer = $this->_getCustomer($order['Customer']);
                    $orderObj->setCustomer($customer);

                    if ($order['HasClaims'] == 'true') {
                        $orderObj->setHasClaims(true);
                    }

                    $orderObj->setInitialTotalAmount(floatval($order['InitialTotalAmount']));
                    $orderObj->setInitialTotalShippingChargesAmount(floatval($order['InitialTotalShippingChargesAmount']));

                    /*
                     * is clogistique order
                     */
                    if ($order['IsCLogistiqueOrder'] == 'true') {
                        $orderObj->setIsCLogistiqueOrder(true);
                    }

                    $orderObj->setLastUpdatedDate($order['LastUpdatedDate']);
                    $orderObj->setModifiedDate($order['ModifiedDate']);

                    if (!SoapTools::isSoapValueNull($order['OrderLineList'])) {
                        $orderLineList = $this->_getOrderLineList($order['OrderLineList']);
                        $orderObj->setOrderLineList($orderLineList);
                    }
                    //TODO gérer offer

                    $orderObj->setOrderState($order['OrderState']);

                    /**
                     * PartnerOrderRef
                     */
                    if(isset($order['PartnerOrderRef']) && !SoapTools::isSoapValueNull($order['PartnerOrderRef'])){
                        $orderObj->setPartnerOrderRef($order['PartnerOrderRef']);
                    }

                    /*
                     * mod ges log
                     */
                    if (isset($order['ModGesLog']) && !SoapTools::isSoapValueNull($order['ModGesLog'])) {
                        $orderObj->setModGesLog($order['ModGesLog']);
                    }

                    $parcelList = $this->_getParcelList($order['ParcelList']);
                    $orderObj->setParcelList($parcelList);
                    
                    if (isset($order['VoucherList']) && !SoapTools::isSoapValueNull($order['VoucherList'])) {
                        $voucherList = $this->_getVoucherList($order['VoucherList']);
                        $orderObj->setVoucherList($voucherList);
                    }
                    
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
    private function _getOrderLineList($orderLineListOBJGlobal)
    {
        $orderLines = $orderLineListOBJGlobal['OrderLine'];
        if (isset($orderLines['ProductId'])){
            $orderLines = array($orderLines);
        }

        $orderLineList = new OrderLineList();

        foreach ($orderLines as $orderLineListOBJ) {

            $orderLine = new OrderLine($orderLineListOBJ['ProductId']);

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
            if (isset($orderLineListOBJ['ProductEan']) && !SoapTools::isSoapValueNull($orderLineListOBJ['ProductEan'])) {
                $orderLine->setProductEan($orderLineListOBJ['ProductEan']);
            }
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
            
            if ($orderLineListOBJ['RefundShippingCharges'] == 'true') {
                $orderLine->setRefundShippingCharges(true);
            }
            $orderLineList->addOrderLine($orderLine);
        }
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
            
            $trackingList = new TrackingList();
            
            if( isset($parcel['TrackingList']) && !SoapTools::isSoapValueNull($parcel['TrackingList']) ){
               /*
                * @var \Sdk\Parcel\Tracking $tracking
                */
               foreach ( $parcel['TrackingList'] as $tracking ){
                    $trackingObj = new Tracking($tracking['TrackingId']);

                    if (isset($tracking['ParcelNum']) && !SoapTools::isSoapValueNull($tracking['ParcelNum']))
                    {
                        $trackingObj->setParcelNum($tracking['ParcelNum']);
                    }

                    if (isset($tracking['Justification']) && !SoapTools::isSoapValueNull($tracking['Justification']))
                    {
                        $trackingObj->setJustification($tracking['Justification']);
                    }

                    if (isset($tracking['InsertDate']) && !SoapTools::isSoapValueNull($tracking['InsertDate']))
                    {
                        $trackingObj->setInsertDate($tracking['InsertDate']);
                    }
                    $trackingList->addTrackingToLit($trackingObj);
                }
                $parcelObj->setTrackingList($trackingList); 
            }
            
            $parcelListObj->addParcel($parcelObj);
        }

        return $parcelListObj;
    }
    
    /*
     * @param \Sdk\Order\VoucherList
     * create vouhcer list object
     */
    private function _getVoucherList($voucherList)
    {
        $voucherListObj = new \Sdk\Order\VoucherList();
        
        /*
         * \Sdk\Order\Voucher
         */
        foreach ($voucherList as $voucher) {
            $voucherObj = new \Sdk\Order\Voucher();

            if (isset($voucher['CreateDate']) && !SoapTools::isSoapValueNull($voucher['CreateDate'])) {
               $voucherObj->setCreateDate($voucher['CreateDate']); 
            }
            
            if (isset($voucher['Source']) && !SoapTools::isSoapValueNull($voucher['Source'])) {
                $voucherObj->setSource($voucher['Source']);
            }
            
            $refundInfomation = new \Sdk\Order\Refund\RefundInformation();
            if (isset($voucher['RefundInformation']) && !SoapTools::isSoapValueNull($voucher['RefundInformation'])) {
                
                if (isset($voucher['RefundInformation']['Amount']) && !SoapTools::isSoapValueNull($voucher['RefundInformation']['Amount'])) {
                    $refundInfomation->setAmount($voucher['RefundInformation']['Amount']);
                }
                if (isset($voucher['RefundInformation']['MotiveId']) && !SoapTools::isSoapValueNull($voucher['RefundInformation']['MotiveId'])) {
                    $refundInfomation->setMotiveId($voucher['RefundInformation']['MotiveId']);
                }
            }

            $voucherObj->setRefundInformation($refundInfomation);
            
            $voucherListObj->addVoucherToList($voucherObj);
        }
        
        return $voucherListObj;
    }
}