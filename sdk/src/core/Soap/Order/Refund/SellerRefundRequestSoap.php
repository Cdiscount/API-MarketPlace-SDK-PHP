<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 18/10/2016
 * Time: 16:55
 */

namespace Sdk\Soap\Order\Refund;


use Sdk\Soap\BaliseTool;

class SellerRefundRequestSoap extends BaliseTool
{

    private $_ModeTAG = 'Mode';
    private $_MotiveTAG = 'Motive';
    private $_RefundOrderLineTAG = 'RefundOrderLine';

    private $_EanTAG = 'Ean';
    private $_SellerProductIdTAG = 'SellerProductId';
    private $_RefundShippingChargesTAG = 'RefundShippingCharges';

    /**
     * @var \Sdk\Soap\Order\Refund\SellerRefundRequestSoap
     */
    private $_sellerRefundRequest = null;

    /**
     * SellerRefundRequestSoap constructor.
     * @param $sellerRefundRequest \Sdk\Order\Refund\SellerRefundRequest
     */
    public function __construct($sellerRefundRequest)
    {
        $this->_sellerRefundRequest = $sellerRefundRequest;

        $this->_tag = 'SellerRefundRequest';
        parent::__construct();
    }

    /**
     * @return string
     */
    public function serialize()
    {
        $xml = $this->_generateOpenBalise();

        /**
         * Mode & Motive
         */
        $xml .= $this->_xmlUtil->generateBalise($this->_ModeTAG, $this->_sellerRefundRequest->getMode());
        $xml .= $this->_xmlUtil->generateBalise($this->_MotiveTAG, $this->_sellerRefundRequest->getMotive());

        /**
         * RefundOrderLine
         */
        $xml .= $this->_xmlUtil->generateOpenBalise($this->_RefundOrderLineTAG);
        $xml .= $this->_xmlUtil->generateBalise($this->_EanTAG, $this->_sellerRefundRequest->getRefundOrderLine()->getEan());
        $xml .= $this->_xmlUtil->generateBalise($this->_SellerProductIdTAG, $this->_sellerRefundRequest->getRefundOrderLine()->getSellerProductId());
        if ($this->_sellerRefundRequest->getRefundOrderLine()->isRefundShippingCharges()) {
            $xml .= $this->_xmlUtil->generateBalise($this->_RefundShippingChargesTAG, 'true');
        }
        else {
            $xml .= $this->_xmlUtil->generateBalise($this->_RefundShippingChargesTAG, 'false');
        }
        $xml .= $this->_xmlUtil->generateCloseBalise($this->_RefundOrderLineTAG);

        $xml .= $this->_generateCloseBalise();
        return $xml;
    }
}