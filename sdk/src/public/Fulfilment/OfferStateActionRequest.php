<?php
/*
 * Created by CDiscount
 * Date: 18/05/2017
 * Time 11:35
 */

namespace Sdk\Fulfilment;

class OfferStateActionRequest
{
    
    /*
     * @var string
     */
    private $_sellerProductId = null;
    
    /*
     * @var enum
     */
    private $_action = null;

    /*
     * @return string
     */
    public function  getSellerProductId()
    {
        return $this->_sellerProductId;
    }

     /*
     * @param $sellerProductId
     */
    public function setSellerProductId($sellerProductId)
    {
        $this-> _sellerProductId = $sellerProductId;
    }

    /*
     * @return enum
     */
    public function getAction()
    {
        return $this->_action;
    }
    
    /*
     * @param $offerStateActionType Sdk\Fulfilment\OfferStateActionType
     */
    public function setAction($offerStateActionType)
    {
        $this-> _action = $offerStateActionType;
    }
    
    /*
     * OfferStateActionRequest constructor
     * @param $sellerProductId string
     * @param $action enum
     */
    public function __construct($sellerProductId, $action) 
    {
        $this->_sellerProductId = $sellerProductId;
        $this->_action = $action;
    }
}


