<?php
/**
 * Created by CDiscount
 * User: CDiscount
 * Date: 22/09/2016
 * Time: 11:43
 */

namespace Sdk\ApiClient;
use Sdk\Auth\Token;
use Sdk\Discussion\DiscussionPoint;
use Sdk\Mail\MailPoint;
use Sdk\Offer\OfferPoint;
use Sdk\Order\OrderPoint;
use Sdk\Product\ProductPoint;
use Sdk\Relays\RelaysPoint;
use Sdk\Seller\SellerPoint;
use Sdk\Fulfilment\FulfilmentPoint;

/**
 * Class CDSApiClient
 *
 * @package ApiClient
 */
class CDSApiClient
{

    /**
     * @var SellerPoint
     */
    private $_sellerPoint = null;

    private $apiUrl = null;
    private $methodUrl = null;

    private $curlOptions = [];

    /**
     * @return SellerPoint
     */
    public function getSellerPoint()
    {
        if ($this->_sellerPoint == null) {
            $this->_sellerPoint = new SellerPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_sellerPoint;
    }

    /**
     * @var \Sdk\Order\OrderPoint
     */
    private $_orderPoint = null;

    /**
     * @return OrderPoint
     */
    public function getOrderPoint()
    {
        if ($this->_orderPoint == null) {
            $this->_orderPoint = new OrderPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_orderPoint;
    }

    /**
     * @var \Sdk\Offer\OfferPoint
     */
    private $_offerPoint = null;

    /**
     * @return OfferPoint
     */
    public function getOfferPoint()
    {
        if ($this->_offerPoint == null) {
            $this->_offerPoint = new OfferPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_offerPoint;
    }

    /**
     * @var \Sdk\Product\ProductPoint
     */
    private $_productPoint = null;

    /**
     * @return ProductPoint
     */
    public function getProductPoint()
    {
        if ($this->_productPoint == null) {
            $this->_productPoint = new ProductPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_productPoint;
    }

    /**
     * @var \Sdk\Fulfilment\FulfilmentPoint
     */
    private $_fulfilmentPoint = null;

    /**
     * @return FulfilmentPoint
     */
    public function getFulfilmentPoint()
    {
        if ($this->_fulfilmentPoint == null) {
            $this->_fulfilmentPoint = new FulfilmentPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_fulfilmentPoint;
    }

    /**
     * @var \Sdk\Discussion\DiscussionPoint
     */
    private $_discussionPoint = null;

    /**
     * @return \Sdk\Discussion\DiscussionPoint
     */
    public function getDiscussionPoint()
    {
        if ($this->_discussionPoint == null) {
            $this->_discussionPoint = new DiscussionPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_discussionPoint;
    }

    /**
     * @var \Sdk\Relays\RelaysPoint
     */
    private $_relaysPoint = null;

    /**
     * @return RelaysPoint
     */
    public function getRelaysPoint()
    {
        if ($this->_relaysPoint == null) {
            $this->_relaysPoint = new RelaysPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_relaysPoint;
    }

    /**
     * @var MailPoint
     */
    private $_mailPoint = null;

    /**
     * @return MailPoint
     */
    public function getMailPoint()
    {
        if ($this->_mailPoint == null) {
            $this->_mailPoint = new MailPoint($this->methodUrl, $this->apiUrl, $this->curlOptions);
        }
        return $this->_mailPoint;
    }

    /**
     * Create and check the token
     */
    public function init(string $username = null, string $password = null, string $tokenUrl = null, string $apiUrl = null, string $methodUrl = null, array $curlOptions = [])
    {
        $this->apiUrl = $apiUrl;
        $this->methodUrl = $methodUrl;
        $this->curlOptions = $curlOptions;
        $token = Token::getInstance($username, $password, $tokenUrl)->getToken();
        return $token;
    }

    /**
     * @return bool
     */
    public function isTokenValid()
    {
        return Token::getInstance()->isTokenValid();
    }
}
