<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 10:05
 */

namespace Sdk\Soap\Seller;


use Sdk\Delivey\DeliveryModeInformation;
use Sdk\Offer\OfferPool;
use Sdk\Seller\Seller;
use Sdk\Seller\Address;
use Sdk\Soap\Common\iResponse;
use Sdk\Soap\Common\SoapTools;

class GetSellerInformationResponse extends iResponse
{
    /**
     * @var Seller
     */
    private $_seller;

    /**
     * @return Seller
     */
    public function getSeller()
    {
        return $this->_seller;
    }

    /**
     * @var array|bool
     */
    private $_dataResponse;

    /**
     * @var array
     */
    private $_offerPoolList = array();

    /**
     * @return null
     */
    public function getOfferPoolList()
    {
        return $this->_offerPoolList;
    }

    /**
     * @var array
     */
    private $_deliveryModes = array();

    /**
     * @return null
     */
    public function getDeliveryModes()
    {
        return $this->_deliveryModes;
    }

    /**
     * GetSellerInformationResponse constructor.
     * @param $response
     * @throws \Exception
     */
    public function __construct($response)
    {
        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($response);

        // Check for error messages
        if (!$this->_hasErrorMessage()) {
            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            /**
             * Seller informations
             */
            $this->_seller = new Seller();
            $this->_setSellerInformations();

            /**
             * DeliveryModes
             */
            $this->_setDeliveryModes();

            /**
             * OfferPoolList informations
             */
            $this->_setOfferPoolList();
        }
    }

    /**
     *
     */
    private function _setSellerInformations()
    {
        $objSellerResult = $this->_dataResponse['s:Body']['GetSellerInformationResponse']['GetSellerInformationResult']{'Seller'};
        $this->_seller->setEmail($objSellerResult['Email']);
        $this->_seller->setIsAvailable($objSellerResult['IsAvailable']);
        $this->_seller->setLogin($objSellerResult['Login']);
        $this->_seller->setMobileNumber($objSellerResult['MobileNumber']);
        $this->_seller->setPhoneNumber($objSellerResult['PhoneNumber']);
        $this->_seller->setShopName($objSellerResult['ShopName']);
        $this->_seller->setShopUrl($objSellerResult['ShopUrl']);
        $this->_seller->setSiretNumber($objSellerResult['SiretNumber']);
        $this->_seller->setState($objSellerResult['State']);

        $objSellerAddressResult = $objSellerResult['SellerAddress'];

        $address = new Address();

        $address->setAddress1($objSellerAddressResult['Address1']);
        $address->setAddress2($objSellerAddressResult['Address2']);
        $address->setApartmentNumber($objSellerAddressResult['ApartmentNumber']);
        $address->setBuilding($objSellerAddressResult['Building']);
        $address->setCity($objSellerAddressResult['City']);
        $address->setCivility($objSellerAddressResult['Civility']);
        $address->setCompanyName($objSellerAddressResult['CompanyName']);
        $address->setCountry($objSellerAddressResult['Country']);
        $address->setCounty($objSellerAddressResult['County']);
        $address->setFirstName($objSellerAddressResult['FirstName']);
        $address->setInstructions($objSellerAddressResult['Instructions']);
        $address->setLastName($objSellerAddressResult['LastName']);
        $address->setPlaceName($objSellerAddressResult['PlaceName']);
        $address->setRelayId($objSellerAddressResult['RelayId']);
        $address->setStreet($objSellerAddressResult['Street']);
        $address->setZipCode($objSellerAddressResult['ZipCode']);
        $this->_seller->setSellerAddress($address);
    }

    private function _setGlobalInformations()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetSellerInformationResponse']['GetSellerInformationResult'];
        $this->_tokenID = $objInfoResult['TokenId'];
        $this->_sellerLogin = $objInfoResult['SellerLogin'];
    }

    /**
     *
     */
    private function _setOfferPoolList()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetSellerInformationResponse']['GetSellerInformationResult']['OfferPoolList'];

        $arrays = false;
        if (isset($objInfoResult['OfferPool'])) {
            foreach ($objInfoResult['OfferPool'] as $offer) {

                if (is_array($offer)) {
                    $arrays = true;
                    array_push($this->_offerPoolList, new OfferPool($offer['Id'], $offer['Description']));
                }
            }
            if (!$arrays) {
                array_push($this->_offerPoolList, new OfferPool($objInfoResult['OfferPool']['Id'], $objInfoResult['OfferPool']['Description']));
            }
        }
    }

    /**
     *
     */
    private function _setDeliveryModes()
    {
        $objInfoResult = $this->_dataResponse['s:Body']['GetSellerInformationResponse']['GetSellerInformationResult']['DeliveryModes'];

        foreach ($objInfoResult['DeliveryModeInformation'] as $delModeInfo) {
            array_push($this->_deliveryModes, new DeliveryModeInformation($delModeInfo['Code'], $delModeInfo['Name']));
        }
    }

    /**
     * @return bool
     */
    private function _hasErrorMessage()
    {
        $objError = $this->_dataResponse['s:Body']['GetSellerInformationResponse']['GetSellerInformationResult']['ErrorMessage'];

        if (isset($objError['_']) && strlen($objError['_']) > 0) {

            $this->_hasError = true;
            $this->_errorMessage = $objError['_'];
            return true;
        }
        return false;
    }
}