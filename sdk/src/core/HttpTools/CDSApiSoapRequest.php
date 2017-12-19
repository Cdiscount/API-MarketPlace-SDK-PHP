<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/10/2016
 * Time: 13:27
 */

namespace Sdk\HttpTools;


class CDSApiSoapRequest
{
    /**
     * @var \Zend\Http\Client\Adapter\Curl
     */
    private $_adapter = null;

    /**
     * @var \Zend\Http\Client
     */
    private $_client = null;

    /**
     * @var \Zend\Http\Request
     */
    private $_request = null;

    /**
     * @var array header
     */
    private $_header = null;

    /**
     * CDSApiSoapRequest constructor.
     *
     * @param $method
     * @param $headerMethodURL
     * @param $apiURL
     * @param $data
     */
    public function __construct($method, $headerMethodURL, $apiURL, $data)
    {

        $this->_client = new \Zend\Http\Client($apiURL);
        $this->_client->setMethod('post');
        $this->_client->setRawBody($data);
        $this->_client->setHeaders(array(
            'Content-Type: text/xml;charset=UTF-8',
            'SOAPAction: http://www.cdiscount.com/IMarketplaceAPIService/' . $method . '',
        ));

        $this->_adapter = new \Zend\Http\Client\Adapter\Curl();
        $this->_setAdapaterOptions($data, $apiURL);
        $this->_client->setAdapter($this->_adapter);
    }

    /**
     * @param $data
     * @param $url
     */
    private function _setAdapaterOptions($data, $url)
    {
        $this->_adapter->setOptions(array(
            'curloptions' => array(
                CURLOPT_URL => $url,
                CURLOPT_VERBOSE => false,
                CURLOPT_HEADER => true,
                CURLOPT_POST => true,
                CURLOPT_SSLVERSION => 4,
                CURLOPT_SSL_VERIFYPEER => FALSE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_TIMEOUT => 600
            )
        ));
    }

    /**
     * @return string
     */
    public function call()
    {
        $response = $this->_client->send();
        return $response->getBody();
    }

}