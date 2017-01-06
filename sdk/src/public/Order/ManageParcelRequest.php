<?php
/**
 * Created by Cdiscount.
 * Date: 13/12/2016
 * Time: 13:57
 */


namespace Sdk\Order;


class ManageParcelRequest
{
    /**
     * @var String
     */
    private $_scopusId = null;

    /**
     * @return String
     */
    public function getScopusId()
    {
        return $this->_scopusId;
    }

    /**
     * @var array
     */
    private $_parcelActionsList = null;

    /**
     * @return array
     */
    public function getParcelActionsList()
    {
        return $this->_parcelActionsList;
    }

    /**
     * @param $parcelInfo \Sdk\Order\ParcelInfos
     */
    public function addParcelAction($parcelInfo)
    {
        array_push($this->_parcelActionsList, $parcelInfo);
    }

    /**
     * ManageParcelRequest constructor.
     * @param $scopusId
     */
    public function __construct($scopusId)
    {
        $this->_scopusId = $scopusId;
        $this->_parcelActionsList = array();
    }
}