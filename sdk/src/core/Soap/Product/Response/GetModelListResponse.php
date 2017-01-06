<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 02/11/2016
 * Time: 10:44
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\ProductModel;
use Sdk\Soap\Common\iResponse;

class GetModelListResponse extends ModelListResponse
{

    /**
     * GetModelListResponse constructor.
     * @param $dataResponse
     */
    public function __construct($dataResponse)
    {
        parent::__construct('GetModelListResponse', 'GetModelListResult');

        $reader = new \Zend\Config\Reader\Xml();
        $this->_dataResponse = $reader->fromString($dataResponse);

        // Check For error message
        if (!$this->_hasErrorMessage()) {

            /**
             * Global informations
             */
            $this->_setGlobalInformations();

            $modelListXML = $this->_dataResponse['s:Body'][$this->_tagXML][$this->_tagResultXML]['ModelList']['ProductModel'];

            $this->_addProductModel($modelListXML);
        }
    }


}