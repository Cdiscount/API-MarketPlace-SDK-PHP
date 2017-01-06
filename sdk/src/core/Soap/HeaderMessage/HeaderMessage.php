<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 28/09/2016
 * Time: 09:15
 */

namespace Sdk\Soap\HeaderMessage;
use Sdk\Soap\XmlUtils;

/**
 * Class HeaderMessage
 * @package Sdk\Soap
 */
class HeaderMessage
{

    /**
     * @var string
     */
    private $_headerChildrenPrefix = 'a:';

    /**
     * @var string
     */
    private $_version;

    /**
     * @var string
     */
    private $_versionTAG = 'Version';

    /**
     * @var string
     */
    private $_headerTAG = 'headerMessage';

    /**
     * @var null|XmlUtils
     */
    private $_xmlUtil = null;

    /**
     * @var string
     */
    private $_xmlnsa = 'xmlns:a="http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages"';

    /**
     * @var string
     */
    private $_xmlnsi = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"';

    /**
     * HeaderMessage constructor.
     * @param string $version
     */
    public function __construct($version = '1.0')
    {
        $this->_version = $version;
        $this->_xmlUtil = new XmlUtils($this->_headerChildrenPrefix);
    }

    /**
     * @return string
     */
    public function generateHeader()
    {
        $inlines = array($this->_xmlnsa, $this->_xmlnsi);

        $context = new Context($this->_headerChildrenPrefix);
        $localization = new Localization($this->_headerChildrenPrefix);
        $security = new Security($this->_headerChildrenPrefix);
        $version = $this->_xmlUtil->generateBalise($this->_versionTAG, $this->_version);

        $this->_xmlUtil->setGlobalPrefix('');

        $headerBaliseOpen = $this->_xmlUtil->generateOpenBaliseWithInline($this->_headerTAG, $inlines);
        $headerBaliseClose = $this->_xmlUtil->generateCloseBalise($this->_headerTAG);

        $headerMessage = $headerBaliseOpen . $context->generateXML() . $localization->generateXML() . $security->generateXML() . $version . $headerBaliseClose;

        return $headerMessage;
    }
}