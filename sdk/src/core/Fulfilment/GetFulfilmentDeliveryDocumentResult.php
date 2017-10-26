<?php

/* 
 * Created by Mohamed MGUILD
 * Date : 10/05/2017
 * Time : 16:34
 */

namespace Sdk\Fulfilment;
use Sdk\Common\CommonResult;

class GetFulfilmentDeliveryDocumentResult extends CommonResult
{
    /*
     * @var string
     */
    private $_pdfDocument = null;
       
    /*
     * FulfilmentDeliveryDocumentResult constructor, initialize array errorList the commonResult
     */
    public function __construct() 
    {
        $this->_errorList = array();
    }

    /*
     * @param $pdfDocument
     */
    public function setPdfDocument($pdfDocument) 
    {
        $this->_pdfDocument = $pdfDocument;
    }

    /*
     * @return string
     */
    public function getPdfDocument()
    {
        return $this->_pdfDocument;
    }
}
