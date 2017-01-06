<?php
/**
 * Created by Cdiscount.
 * Date: 13/12/2016
 * Time: 14:46
 */


namespace Sdk\Soap\Order;


use Sdk\Soap\BaliseTool;

class ManageParcelSoap extends BaliseTool
{
    #region privateTAG

    /**
     * @var string
     */
    private $_manageParcelRequestTAG = 'manageParcelRequest';

    /**
     * @var string
     */
    private $_ScopusIdTAG = 'ScopusId';

    /**
     * @var string
     */
    private $_parcelActionsListTAG = 'ParcelActionsList';

    /**
     * @var string
     */
    private $_ParcelInfosTAG = 'ParcelInfos';

    /**
     * @var string
     */
    private $_ParcelNumberTAG = 'ParcelNumber';

    /**
     * @var string
     */
    private $_SkuTAG = 'Sku';

    /**
     * @var string
     */
    private $_parcelActionsTAG = 'ManageParcel';

    #endregion

    /**
     * ManageParcelSoap constructor.
     * @param string $xmlns
     */
    public function __construct($xmlns = 'xmlns="http://www.cdiscount.com"')
    {
        $this->_xmlns = $xmlns;
        $this->_tag = 'ManageParcel';
        parent::__construct();
    }

    /**
     * @param $request \Sdk\Order\ManageParcelRequest
     * @param $namespace
     * @return string
     */
    public function generateManageParcelRequestXML($request, $namespace)
    {
        $this->_xmlUtil->setGlobalPrefix($namespace);

        /** Balise ouvrante manageParcelRequest */
        $xml = $this->_xmlUtil->generateOpenBalise($this->_manageParcelRequestTAG);

        /** Balise ouvrante parcelActionsList */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_parcelActionsListTAG);

        /** @var \Sdk\Order\ParcelInfos $parcelInfo */
        foreach ($request->getParcelActionsList() as $parcelInfo) {


            /** Balise ouvrante ParcelInfos */
            $xml .= $this->_xmlUtil->generateOpenBalise($this->_ParcelInfosTAG);

            /** Balise parcelActions */
            $xml .= $this->_xmlUtil->generateBalise($this->_parcelActionsTAG, $parcelInfo->getParcelActions());
            /** Balise ParcelNumber */
            $xml .= $this->_xmlUtil->generateBalise($this->_ParcelNumberTAG, $parcelInfo->getParcelNumber());
            /** Balise SKU */
            $xml .= $this->_xmlUtil->generateBalise($this->_SkuTAG, $parcelInfo->getSku());

            /** Balise fermante ParcelInfos */
            $xml .= $this->_xmlUtil->generateCloseBalise($this->_ParcelInfosTAG);
        }

        /** Balise fermante parcelActionsList */
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_parcelActionsListTAG);

        /** Balise ScopusId */
        $xml .= $this->_xmlUtil->generateBalise($this->_ScopusIdTAG, $request->getScopusId());

        /** Balise fermante manageParcelRequest */
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_manageParcelRequestTAG);

        $this->_xmlUtil->setGlobalPrefix('');

        return $xml;
    }
}

