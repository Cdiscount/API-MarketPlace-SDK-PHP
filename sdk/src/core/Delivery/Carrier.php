<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 01/12/2016
 * Time: 12:15
 */

namespace Sdk\Delivey;


class Carrier
{
    /**
     * @var int
     */
    private $_carrierId = 0;

    /**
     * @return int
     */
    public function getCarrierId()
    {
        return $this->_carrierId;
    }

    /**
     * @var string
     */
    private $_defaultURL = null;

    /**
     * @return string
     */
    public function getDefaultURL()
    {
        return $this->_defaultURL;
    }

    /**
     * @param string $defaultURL
     */
    public function setDefaultURL($defaultURL)
    {
        $this->_defaultURL = $defaultURL;
    }

    /**
     * @var string
     */
    private $_name = null;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * Carrier constructor.
     * @param $carrierId int
     */
    public function __construct($carrierId)
    {
        $this->_carrierId = $carrierId;
    }
}