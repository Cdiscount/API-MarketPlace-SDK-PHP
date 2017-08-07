<?php
/* 
 * Created by Zakaria Boukhris
 * Date : 27/04/2017
 * Time : 15:46
 */
namespace Sdk\Fulfilment;

class SupplyOrderRequest
{
    /**
     * @var array
     */
    private $_supplyOrderList = null;
    private $_pageNumber = null;
    private $_pageSize = null;
    private $_beginModificationDate = null;
    private $_endModificationDate = null;
    
    /**
     * @return array
     */
    public function getSupplyOrderList()
    {
        return $this->_supplyOrderList;
    }

    /**
     * @param $supplyOrder \Sdk\Fulfilement\SupplyOrder 
     */
    public function addSupplyOrder($supplyOrder)
    {
        array_push($this->_supplyOrderList, $supplyOrder);
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->_pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize)
    {
        $this->_pageSize = $pageSize;
    } 

     /**
     * @return int
     */
    public function getPageNumber()
    {
        return $this->_pageNumber;
    }

    /**
     * @param int $pageNumber
     */
    public function setPageNumber($pageNumber)
    {
        $this->_pageNumber = $pageNumber;
    }

    /**
     * @return string
     */
    public function getBeginModificationDate()
    {
        return $this->_beginModificationDate;
    }

    /**
     * @param beginModificationDate
     */
    public function setBeginModificationDate($beginModificationDate)
    {
        $this->_beginModificationDate = $beginModificationDate;
    }

    /**
     * @return string
     */
    public function getEndModificationDate()
    {
        return $this->_endModificationDate;
    }

    /**
     * @param endModificationDate
     */
    public function setEndModificationDate($endModificationDate)
    {
        $this->_endModificationDate = $endModificationDate;
    }
    
    /*
     * SupplyOrderRequest constructor
     */
    public function __construct() 
    {
        $this->_supplyOrderList = array();
    }
}