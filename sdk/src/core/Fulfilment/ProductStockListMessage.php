<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 28/04/2017
 * Time: 09:52
 */

namespace Sdk\Fulfilment;

/**
 * Product Stock List Message class
 */
class ProductStockListMessage
{

    /**
     * @var array
     */
    private $_productStockList = null;

    /**
     * @return array
     */
    public function getProductStockList()
    {
        return $this->_productStockList;
    }

    /**
     * @param array $productStockList
     */
    public function setProductStockList($productStockList)
    {
        $this->_productStockList = $productStockList;  
    }

    /**
     * @var enum
     */
    private $_status = null;

    /**
     * @return Enum
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param Enum $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @var int
     */
    private $_totalProductCount = null;

    /**
     * @return int
     */
    public function getTotalProductCount()
    {
        return $this->_totalProductCount;
    }

    /**
     * @param int $totalProductCount
     */
    public function setTotalProductCount($totalProductCount)
    {
        $this->_totalProductCount = $totalProductCount;
    }
}