<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 20/10/2016
 * Time: 16:30
 */

namespace Sdk\Product;


class KeyValueProperty
{

    /**
     * @var string
     */
    private $_key = null;

    /**
     * @var array|null
     */
    private $_values = array();

    /**
     * KeyValueProperty constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->_key = $key;
    }

    /**
     * @return array|null
     */
    public function getValues()
    {
        return $this->_values;
    }

    /**
     * @param $value string
     */
    public function addValue($value) {
        array_push($this->_values, $value);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }
}