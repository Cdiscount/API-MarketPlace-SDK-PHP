<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 28/09/2016
 * Time: 11:33
 */

namespace Sdk\Soap;

use DOMDocument;
use SoapClient;

class SoapClientDebug extends SoapClient
{
    public function __doRequest($request, $location, $action, $version, $one_way = 0) {
        // Add code to inspect/dissect/debug/adjust the XML given in $request here
        //echo "$request\n"; // OK, but XML string in single line
        $doc = new DomDocument('1.0');
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($request);
        $xml_string = $doc->saveXML();
        echo "$xml_string\n";
        // Uncomment the following line, if you actually want to do the request
        // return parent::__doRequest($request, $location, $action, $version, $one_way);
        return ""; # avoids the PHP Fatal error:  Uncaught SoapFault exception: [Client] SoapClient::__doRequest() returned non string value in .../__thisfile__.php:32

    }
}
