<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 14/11/2016
 * Time: 14:33
 */

namespace Sdk\Soap\Mail;


use Sdk\Soap\BaliseTool;

class Request extends BaliseTool
{

    /**
     * @var string
     */
    private $_RequestTAG = 'request';

    /**
     * @var string
     */
    private $_LongTAG = 'arr:long';

    /**
     * @var string
     */
    private $_DiscussionIdsTAG = 'DiscussionIds';

    /**
     * @var string
     */
    private $_ScopusIdTAG = 'ScopusId';

    /**
     * Request constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'Request';
        parent::__construct();
    }

    /**
     * @param $discussionIds
     * @return string
     */
    public function generateDiscussionIds($discussionIds)
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_RequestTAG, array('xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"'));
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_DiscussionIdsTAG);
        foreach ($discussionIds as $long) {
            $xml .= $this->_xmlUtil->generateBalise($this->_LongTAG, $long);
        }
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_DiscussionIdsTAG);
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_RequestTAG);
        return $xml;
    }

    /**
     * @param $orderIds
     * @return string
     */
    public function generateScopusIds($orderIds)
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_RequestTAG, array('xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"'));
        foreach ($orderIds as $long) {
            $xml .= $this->_xmlUtil->generateBalise($this->_ScopusIdTAG, $long);
        }
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_RequestTAG);
        return $xml;
    }
}