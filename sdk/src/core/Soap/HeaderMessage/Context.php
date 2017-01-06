<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 27/09/2016
 * Time: 16:59
 */

namespace Sdk\Soap\HeaderMessage;
use Sdk\Soap\XmlUtils;


/**
 * Class Context
 *
 * @package Soap
 */
class Context
{

    private $_catalogID;

    private $_customerPoolID;

    private $_siteID;

    private $_catalogIDTAG = 'CatalogID';
    private $_customerPoolIDTAG = 'CustomerPoolID';
    private $_siteIDTAG = 'SiteID';

    private $_contextTAG = 'Context';

    private $_xmlUtil = null;

    public function __construct($prefix, $catalogID = 1, $customerPoolID = 1, $siteID = 100)
    {
        $this->_globalPrefix = $prefix;
        $this->_catalogID = $catalogID;
        $this->_customerPoolID = $customerPoolID;
        $this->_siteID = $siteID;

        $this->_xmlUtil = new XmlUtils($prefix);
    }

    public function generateXML()
    {
        $openContext = $this->_xmlUtil->generateOpenBalise($this->_contextTAG);
        $catalog = $this->_xmlUtil->generateBalise($this->_catalogIDTAG, $this->_catalogID);
        $customerPoolID = $this->_xmlUtil->generateBalise($this->_customerPoolIDTAG, $this->_customerPoolID);
        $siteID = $this->_xmlUtil->generateBalise($this->_siteIDTAG, $this->_siteID);
        $closeContext = $this->_xmlUtil->generateCloseBalise($this->_contextTAG);

        $contextObj = $openContext . $catalog . $customerPoolID . $siteID . $closeContext;

        return $contextObj;
    }


}