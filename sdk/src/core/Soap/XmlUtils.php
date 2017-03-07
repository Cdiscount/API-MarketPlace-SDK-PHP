<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 29/09/2016
 * Time: 16:58
 */

namespace Sdk\Soap;


class XmlUtils
{
    private $_xmlOpenPrefix = '<';
    private $_xmlClosePrefix = '>';
    private $_xmlOpenEndPrefix = '</';
    private $_xmlAutoClosePrefix = '/>';

    private $_globalPrefix = '';

    /**
     * XmlUtils constructor.
     * @param $prefix
     */
    public function __construct($prefix)
    {
        $this->_globalPrefix = $prefix;
    }

    /**
     * @param $prefix
     */
    public function setGlobalPrefix($prefix)
    {
        $this->_globalPrefix = $prefix;
    }

    /**
     * @return string
     */
    public function getGlobalPrefix()
    {
        return $this->_globalPrefix;
    }

    /**
     * @param $tag
     * @param $value
     * @return string
     */
    public function generateBalise($tag, $value)
    {
        $balise = $this->_xmlOpenPrefix . $this->_globalPrefix . $tag . $this->_xmlClosePrefix .
            $value .
            $this->_xmlOpenEndPrefix . $this->_globalPrefix . $tag . $this->_xmlClosePrefix;
        return $balise;
    }

    /**
     * @param $tag
     * @return string
     */
    public function generateOpenBalise($tag)
    {
        return $this->_xmlOpenPrefix . $this->_globalPrefix . $tag . $this->_xmlClosePrefix;
    }

    /**
     * @param $tag
     * @return string
     */
    public function generateCloseBalise($tag)
    {
        return $this->_xmlOpenEndPrefix . $this->_globalPrefix . $tag . $this->_xmlClosePrefix;
    }

    /**
     * @param $tag
     * @param $inlineTAG
     * @param $value
     * @return string
     */
    public function generateAutoClosingBalise($tag, $inlineTAG, $value)
    {
        return $this->_xmlOpenPrefix . $this->_globalPrefix . $tag . ' ' . $inlineTAG . '="' . $value . '" ' . $this->_xmlAutoClosePrefix;
    }

    /**
     * @param $tag
     * @param $inlines
     * @return string
     */
    public function generateOpenBaliseWithInline($tag, $inlines)
    {
        $balise = $this->_xmlOpenPrefix . $this->_globalPrefix . $tag . ' ';
        foreach ($inlines as $inline) {
            $balise .= $inline . ' ';
        }
        return $balise . $this->_xmlClosePrefix;
    }

    /**
     * <cdis:OrderNumberList i:nil="true"/>
     *
     * @param $tag
     * @param $inlineTAG
     * @param $value
     * @return string
     */
    public function generateAutoClosingBaliseWithInline($tag, $inlineTAG, $value)
    {
        return $this->_xmlOpenPrefix . $this->_globalPrefix . $tag . ' ' . $inlineTAG . '="' . $value . '" ' . $this->_xmlAutoClosePrefix;
    }
}