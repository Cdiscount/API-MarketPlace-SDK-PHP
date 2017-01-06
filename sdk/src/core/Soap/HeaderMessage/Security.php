<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/10/2016
 * Time: 09:32
 */

namespace Sdk\Soap\HeaderMessage;


use Sdk\Auth\Token;
use Sdk\Soap\XmlUtils;

class Security
{

    private $_tag = 'Security';

    private $_domainRightsList;

    private $_domainRightsListTAG = 'DomainRightsList';

    private $_issuerID;

    private $_issuerIDTAG = 'IssuerID';

    private $_sessionID;

    private $_SessionIDTAG = 'SessionID';

    private $_subjectLocality;

    private $_subjectLocalityTAG = 'SubjectLocality';

    private $_tokenId;

    private $_tokenIdTAG = 'TokenId';

    private $_userName;

    private $_userNameTAG = 'UserName';

    private $_inlineTAG = 'i:nil';

    public function __construct($prefix, $domainRightsList = 'true', $issuerID = 'true', $sessionID = 'true', $subjectLocality = 'true', $userName = 'true')
    {
        $this->_globalPrefix = $prefix;

        $this->_domainRightsList = $domainRightsList;
        $this->_issuerID = $issuerID;
        $this->_sessionID = $sessionID;
        $this->_subjectLocality = $subjectLocality;
        $this->_tokenId = Token::getInstance()->getToken();
        $this->_userName = $userName;

        $this->_xmlUtil = new XmlUtils($prefix);
    }

    public function generateXML()
    {
        $obj = $this->_xmlUtil->generateOpenBalise($this->_tag);
        $obj .= $this->_xmlUtil->generateAutoClosingBalise($this->_domainRightsListTAG, $this->_inlineTAG, $this->_domainRightsList);
        $obj .= $this->_xmlUtil->generateAutoClosingBalise($this->_issuerIDTAG, $this->_inlineTAG, $this->_issuerID);
        $obj .= $this->_xmlUtil->generateAutoClosingBalise($this->_SessionIDTAG, $this->_inlineTAG, $this->_sessionID);
        $obj .= $this->_xmlUtil->generateAutoClosingBalise($this->_subjectLocalityTAG, $this->_inlineTAG, $this->_subjectLocality);
        $obj .= $this->_xmlUtil->generateBalise($this->_tokenIdTAG, $this->_tokenId);
        $obj .= $this->_xmlUtil->generateAutoClosingBalise($this->_userNameTAG, $this->_inlineTAG, $this->_userName);
        $obj .= $this->_xmlUtil->generateCloseBalise($this->_tag);

        return $obj;
    }
}