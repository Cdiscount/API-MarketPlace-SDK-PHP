<?php
/* 
 * Created by Cdiscount
 * Date : 18/01/2017
 * Time : 15:46
 */
namespace Sdk\Order;

class ManageParcelRequest
{
    /**
     * @var string
     */
    private $_scopusId = null;
    
    /**
     * @return string
     */
    public function getScopusId()
    {
        return $this->_scopusId;
    }
    
    /**
     * @var array
     */
    private $_parcelActionsList = array();
    
    /**
     * @return array
     */
    public function getParcelActionsList()
    {
        return $this->_parcelActionsList;
    }
    
    /**
     * @param $parcelInfos \Sdk\Order\ParcelInfos 
     */
    public function addParcelActionsList($parcelInfos)
    {
        array_push($this->_parcelActionsList, $parcelInfos);
    }
    
    /*
     * ManageParcelRequest constructor
     * @param $scopusId
     */
    public function __construct($scopusId) 
    {
        $this->_scopusId = $scopusId;
    }
}


