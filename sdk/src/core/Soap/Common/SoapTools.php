<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 10/10/2016
 * Time: 11:53
 */

namespace Sdk\Soap\Common;


class SoapTools
{

    public static function isSoapValueNull($value)
    {
        if ((isset($value['nil']) && $value['nil'] == 'true') || (empty($value))) {
            return true;
        }
        return false;
    }
}