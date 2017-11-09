<?php

/**
 * Created by Zakaria Boukhris
 */

namespace Sdk\Fulfilment;

class SupplyOrderList
{
    /*
     * @var array
     */
    private $_supplyOrderList = array();
    
    /*
     * return array
     */
    public function getSupplyOrderList()
    {
        return $this->_supplyOrderList;
    }
    
    /**
     * @param $supplyOrderList
     */
    public function addSupplyOrderListToArray($supplyOrderList)
    {
        array_push($this->_supplyOrderList, $supplyOrderList);
    }
}
