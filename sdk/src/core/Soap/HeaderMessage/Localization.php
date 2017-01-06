<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/10/2016
 * Time: 09:14
 */

namespace Sdk\Soap\HeaderMessage;


use Sdk\Soap\XmlUtils;

class Localization
{

    private $_country;

    private $_currency;

    private $_decimalPosition;

    private $_language;

    private $_countryTAG = 'Country';

    private $_currencyTAG = 'Currency';

    private $_decimalPositionTAG = 'DecimalPosition';

    private $_languageTAG = 'Language';

    private $_tag = 'Localization';

    public function __construct($prefix, $country = 'Fr', $currency = 'Eur', $decimalPosition = 2, $language = 'Fr')
    {
        $this->_globalPrefix = $prefix;

        $this->_country = $country;
        $this->_currency = $currency;
        $this->_decimalPosition = $decimalPosition;
        $this->_language = $language;

        $this->_xmlUtil = new XmlUtils($prefix);
    }

    public function generateXML()
    {
        $contextObj = $this->_xmlUtil->generateOpenBalise($this->_tag);
        $contextObj .= $this->_xmlUtil->generateBalise($this->_countryTAG, $this->_country);
        $contextObj .= $this->_xmlUtil->generateBalise($this->_currencyTAG, $this->_currency);
        $contextObj .= $this->_xmlUtil->generateBalise($this->_decimalPositionTAG, $this->_decimalPosition);
        $contextObj .= $this->_xmlUtil->generateBalise($this->_languageTAG, $this->_language);
        $contextObj .= $this->_xmlUtil->generateCloseBalise($this->_tag);

        return $contextObj;
    }

}