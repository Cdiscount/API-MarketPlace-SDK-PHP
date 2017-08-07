<?php
/*
 * Created by CDiscount
 * Date: 04/05/2017
 */
 
namespace Sdk\Fulfilment;

class SupplyOrderReport
{
    /*
     * @var long
     */
    private $_depositId = null;
    
    /*
     * @var array
     */
    private $_reportLineList = null;

     /*
     * @return array
     */
    public function getReportLineList()
    {
        return $this->_reportLineList;
    }
    
    /*
     * @return long
     */
    public function getDepositId()
    {
        return $this->_depositId;
    }
    
     /*
     * @param $depositId
     */
    public function setDepositId($depositId)
    {
        $this->_depositId=$depositId;
    }
    
    /*
     * @param $_reportLineList
     */
    public function addReportLineList($reportLineList)
    {
        array_push($this->_reportLineList, $reportLineList);
    }

     /*
     * SupplyOrderReport constructor
     */
    public function __construct() 
    {
         $this->_reportLineList = array();
    } 
}
