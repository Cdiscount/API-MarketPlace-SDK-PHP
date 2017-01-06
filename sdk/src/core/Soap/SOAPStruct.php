<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 28/09/2016
 * Time: 14:18
 */

namespace Sdk\Soap;


class SOAPStruct {

    public $CatalogID = 1;
    public $CustomerPoolID = 1;
    public $SiteID = 100;


    public function __construct($s, $i, $f)
    {
        $this->CatalogID = $s;
        $this->CustomerPoolID = $i;
        $this->SiteID = $f;
    }
}