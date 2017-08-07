<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */

namespace Sdk\Fulfilment;

class SupplyOrderReportRequest
{
    /*
     * @var string
     */
    private $_beginCreationDate = null;
    
    /*
     * @var array
     */
    private $_depositIdList = null;

    /*
     * @var string
     */
    private $_endCreationDate = null;

    /*
     * @var int
     */
    private $_pageNumber = null;

    /*
     * @var int
     */
    private $_pageSize = null;
    
    /*
     * @return string
     */
    public function getBeginCreationDate()
    {
        return $this->_beginCreationDate;
    }
    
     /*
     * @return array
     */
    public function getDepositIdList()
    {
        return $this->_depositIdList;
    }
    
    /*
     * @param $depositIdList
     */
    public function addDepositIdList($depositIdList)
    {
        array_push($this->_depositIdList, $depositIdList);
    }

     /*
     * @return string
     */
    public function getEndCreationDate()
    {
        return $this->_endCreationDate;
    }

    /*
     * @return int
     */
    public function getPageNumber()
    {
        return $this->_pageNumber;
    }
   
   /*
     * @return int
     */
    public function getPageSize()
    {
        return $this->_pageSize;
    }
    /*
     * SupplyOrderReportRequest constructor
     * @param $beginCreationDate
     * @param $depositIdList
     * @param $endCreationDate
     * @param $pageNumber
     * @param $pageSize
     */
    public function __construct($beginCreationDate, $depositIdList, $endCreationDate, $pageNumber, $pageSize) 
    {
        $this-> _beginCreationDate = $beginCreationDate;
        $this-> _depositIdList = $depositIdList;
        $this-> _endCreationDate = $endCreationDate;
        $this-> _pageNumber = $pageNumber;
        $this-> _pageSize = $pageSize;
    } 
}
