<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 13:57
 */

namespace Sdk\Delivey;


class DeliveryModeInformation extends DeliveryMode
{

    /**
     * DeliveryModeInformation constructor.
     * @param $code
     * @param $name
     */
    public function __construct($code, $name)
    {
        $this->_code = $code;
        $this->_name = $name;
    }
}