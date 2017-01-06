<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 09/11/2016
 * Time: 13:32
 */

namespace Sdk\Soap\Discussion;


use Sdk\Soap\BaliseTool;

class CloseDiscussionList extends BaliseTool
{

    private $_closeDiscussionRequestTAG = 'closeDiscussionRequest';

    private $_DiscussionIdTAG = 'arr:long';

    /**
     * CloseDiscussionList constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'CloseDiscussionList';
        parent::__construct();
    }

    /**
     * @param $discussionIds
     * @return string
     */
    public function generateCloseDiscussionRequestXML($discussionIds)
    {
        $xml = $this->_xmlUtil->generateOpenBaliseWithInline($this->_closeDiscussionRequestTAG, array('xmlns:arr="http://schemas.microsoft.com/2003/10/Serialization/Arrays"'));

        foreach ($discussionIds as $discussionId) {
            $xml .= $this->_xmlUtil->generateBalise($this->_DiscussionIdTAG, $discussionId);
        }

        $xml .= $this->_xmlUtil->generateCloseBalise($this->_closeDiscussionRequestTAG);

        return $xml;
    }
}