<?php

namespace Sdk;

use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiSoapRequest;

abstract class AbstractPoint
{
    /**
     * api end point urls
     *
     * @var string
     */
    protected $headerRequestURL = null;
    protected $apiUrl           = null;
    /**
     * curl options
     *
     * @var array
     */
    protected $curlOptions  = [];

    public function __construct(string $headerRequestURL = null, string $apiUrl = null, array $curlOptions = [])
    {
        $this->curlOptions = $curlOptions;
        $this->headerRequestURL = $headerRequestURL;
        if (null === $this->headerRequestURL) {
            $this->headerRequestURL = ConfigFileLoader::getInstance()->getConfAttribute('methodurl');
        }

        $this->apiUrl = $apiUrl;
        if (null === $this->apiUrl) {
            $this->apiUrl = ConfigFileLoader::getInstance()->getConfAttribute('url');
        }
    }
    /**
     * @param $method
     * @param $data
     * @return string
     */
    protected function _sendRequest($method, $data)
    {
        $request = new CDSApiSoapRequest($method, $this->headerRequestURL, $this->apiUrl, $data, $this->curlOptions);
        $response = $request->call();

        return $response;
    }
}
