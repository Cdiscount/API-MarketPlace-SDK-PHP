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

    private $_headerChildrenPrefix = 'a:';

    private $_version;

    private $_versionTAG = 'Version';

    private $_headerTAG = 'headerMessage';

    private $_xmlUtil = null;

    private $_xmlnsa = 'xmlns:a="http://schemas.datacontract.org/2004/07/Cdiscount.Framework.Core.Communication.Messages"';

    private $_xmlnsi = 'xmlns:i="http://www.w3.org/2001/XMLSchema-instance"';

    public function __construct($version = '1.0')
    {
        $this->_version = $version;
        $this->_xmlUtil = new XmlUtils($this->_headerChildrenPrefix);
    }

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

        /*

        $e->generateXML();

        $newsXML = new SimpleXMLElement("<news></news>");
        $newsXML->addAttribute('newsPagePrefix', 'value goes here');
        $newsIntro = $newsXML->addChild('content');
        $newsIntro->addAttribute('type', 'latest');
        echo $newsXML->asXML();
        */

        /*
        $client = new SoapClientDebug(
            null,
            array(
                'location' => 'https://example.com/ExampleWebServiceDL/services/ExampleHandler',
                'uri' => 'http://example.com/wsdl',
                'trace' => 1,
                'use' => SOAP_LITERAL,
                'style' => SOAP_DOCUMENT,
            )
        );
        $params = new \SoapVar("<Echo><a:Acquirer><Id>MyId</Id><UserId>MyUserId</UserId><Password>MyPassword</Password></a:Acquirer></Echo>", XSD_ANYXML);
        $result = $client->MethodNameIsIgnored($params);
        */
    }

}