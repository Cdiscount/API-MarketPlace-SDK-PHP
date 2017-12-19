<?php

/* 
 * Created by Cdiscount
 * Date : 02/05/2017
 * Time : 12:34
 */

namespace Sdk\Fulfilment;
use Sdk\Common\CommonResult;

class FulfilmentSupplyOrderResult extends CommonResult
{
     /*
    * @var int
    */
    private $_currentPageNumber = 0;

    /*
    * @var int
    */
    private $_numberOfPages = 0;

    /*
     * @var array
     */
    private $_supplyOrderList = array();

    /*
    * return $_currentPageNumber
    */
    public function getCurrentPageNumber()
    {
        return $this->_currentPageNumber;
    }

    /*
     * @param $currentPageNumber
     */
    public function setCurrentPageNumber($currentPageNumber)
    {
        $this->_currentPageNumber = $currentPageNumber;
    }

    /*
    * return $_currentPage
    */              
    public function getNumberOfPages()
    {
        return $this->_numberOfPages;
    }

    /*
     * @param $numberOfPages
     */
    public function setNumberOfPages($numberOfPages)
    {
        $this->_numberOfPages = $numberOfPages;
    }

    /*
     * @return array
     */
    public function getSupplyOrderList()
    {
        return $this->_supplyOrderList;
    }

    /**
     * @param $supplyOrder \Sdk\Fulfilment\SupplyOrder
     */
    public function addSupplyOrderToList($supplyOrder)
    {
        array_push($this->_supplyOrderList, $supplyOrder);
    }
       
    /*
     * SubmitFulfilmentSupplyOrderResult constructor, initialize array erorList the commonResult
     */
    public function __construct() 
    {
        $this->_errorList = array();
    }
}