<?php
/*
 * Created by EQUIPE-SQLI
 * Date: 15/05/2017
 */
 
namespace Sdk\Fulfilment;

class FulfilmentActivationReport
{
    /*
     * @var int
     */
    private $_depositId = null;
    
    /*
     * @var array
     */
    private $_fulfilmentActivationReportDetails = null;

    /*
     * @var int
     */
    private $_numberOfActivatedProducts = null;

     /*
     * @var int
     */
    private $_numberOfDeactivatedProducts = null;

     /*
     * @var int
     */
    private $_numberOfProcessedProducts = null;

     /*
     * @var int
     */
    private $_numberOfProducts = null;

     /*
     * @var int
     */
    private $_numberOfProductsInError = null;

     /*
     * @var int
     */
    private $_numberOfRemainingProductsToProcess = null;

      /*
     * @var date
     */
    private $_reportDate = null;


     /*
     * @return array
     */
    public function getFulfilmentActivationReportDetails()
    {
        return $this->_fulfilmentActivationReportDetails;
    }
    
    /*
     * @return int
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
     * @param $fulfilmentActivationReportDetails
     */
    public function addFulfilmentActivationReportDetails($fulfilmentActivationReportDetails)
    {
        array_push($this->_fulfilmentActivationReportDetails, $fulfilmentActivationReportDetails);
    }

    /*
     * @return int
     */
    public function getNumberOfActivatedProducts()
    {
        return $this->_numberOfActivatedProducts;
    }
    
     /*
     * @param $numberOfActivatedProducts
     */
    public function setNumberOfActivatedProducts($numberOfActivatedProducts)
    {
        $this->_numberOfActivatedProducts=$numberOfActivatedProducts;
    }

    /*
     * @return int
     */
    public function getNumberOfDeactivatedProducts()
    {
        return $this->_numberOfDeactivatedProducts;
    }
    
     /*
     * @param $numberOfDeactivatedProducts
     */
    public function setNumberOfDeactivatedProducts($numberOfDeactivatedProducts)
    {
        $this->_numberOfDeactivatedProducts=$numberOfDeactivatedProducts;
    }

     /*
     * @return int
     */
    public function getNumberOfProcessedProducts()
    {
        return $this->_numberOfProcessedProducts;
    }
    
     /*
     * @param $_numberOfProcessedProducts
     */
    public function setNumberOfProcessedProducts($numberOfProcessedProducts)
    {
        $this->_numberOfProcessedProducts=$numberOfProcessedProducts;
    }

    /*
     * @return int
     */
    public function getNumberOfProducts()
    {
        return $this->_numberOfProducts;
    }
    
     /*
     * @param $numberOfProducts
     */
    public function setNumberOfProducts($numberOfProducts)
    {
        $this->_numberOfProducts=$numberOfProducts;
    }

    /*
     * @return int
     */
    public function getNumberOfProductsInError()
    {
        return $this->_numberOfProductsInError;
    }
    
     /*
     * @param $numberOfProductsInError
     */
    public function setNumberOfProductsInError($numberOfProductsInError)
    {
        $this->_numberOfProductsInError=$numberOfProductsInError;
    }

    /*
     * @return int
     */
    public function getNumberOfRemainingProductsToProcess()
    {
        return $this->_numberOfRemainingProductsToProcess;
    }
    
     /*
     * @param $numberOfRemainingProductsToProcess
     */
    public function setNumberOfRemainingProductsToProcess($numberOfRemainingProductsToProcess)
    {
        $this->_numberOfRemainingProductsToProcess=$numberOfRemainingProductsToProcess;
    }

     /*
     * @return int
     */
    public function getReportDate()
    {
        return $this->_reportDate;
    }
    
     /*
     * @param $reportDate
     */
    public function setReportDate($reportDate)
    {
        $this->_reportDate=$reportDate;
    }

     /*
     * SupplyOrderReport constructor
     */
    public function __construct() 
    {
         $this->_fulfilmentActivationReportDetails = array();
    } 
}
