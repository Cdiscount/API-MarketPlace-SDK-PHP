<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 04/11/2016
 * Time: 15:29
 */

namespace Sdk\Product;


use Sdk\Common\ReportLog;
use Sdk\Soap\Common\SoapTools;

class ProductReportLog extends ReportLog
{
    /**
     * @var string
     */
    private $_productIntegrationStatus = null;

    /**
     * @return string
     */
    public function getProductIntegrationStatus()
    {
        return $this->_productIntegrationStatus;
    }

    /**
     * @param string $productIntegrationStatus
     */
    public function setProductIntegrationStatus($productIntegrationStatus)
    {
        if (!SoapTools::isSoapValueNull($productIntegrationStatus)) {
            $this->_productIntegrationStatus = $productIntegrationStatus;
        }
    }

    /**
     * @param $productReportPropertyLog ProductReportPropertyLog
     */
    public function addProductReportPropertyLog($productReportPropertyLog)
    {
        if ($this->_propertyList == null) {
            $this->_propertyList = array();
        }
        array_push($this->_propertyList, $productReportPropertyLog);
    }


}