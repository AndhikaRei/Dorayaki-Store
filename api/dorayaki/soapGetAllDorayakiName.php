<?php
include_once __DIR__."/../helper.php";
// Make a soap request.
try {
    $soapClient = new SoapClient('http://localhost:6123/ds/dorayaki?wsdl');
    $params = array (
        // TODO: Change real url.
        // Endpoint.
        "arg0" => "api/v1/dorayaki/name"
    );
    $dorayakiName = $soapClient->getAllDorayakiName($params);
    
    if (is_string($dorayakiName->return)){
        if (startsWith($dorayakiName->return, "Error")){
            throw new Exception($dorayakiName->return);
        }
    }
    
} catch (Exception $e) {
    $err = $e->getMessage();
}