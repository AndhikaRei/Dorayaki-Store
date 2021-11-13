<?php

try {
    $soapClient = new SoapClient('http://localhost:6123/ds/dorayaki?wsdl');
    $params = array (
        "arg0" => "api/v1/dorayaki/name"
    );
    $response = $soapClient->getAllDorayakiName($params);
    
    foreach ($response->return as $r){
        echo $r;
    }
    var_dump($response);
} catch (Exception $e) {
    echo $e->getMessage();
}