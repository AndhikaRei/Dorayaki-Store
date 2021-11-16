<?php
include_once __DIR__."/../helper.php";
include_once __DIR__."/helperDorayaki.php";

// Make a soap request.
try {
    $soapClient = new SoapClient('http://localhost:6123/ds/request?wsdl');
    $params = array (
        // TODO: Change real url.
        // Endpoint.
        "arg0" => "api/v1/dorayaki/sync",
    );
    $res = $soapClient->syncRequest($params);
    if (isset($res->return)){
        $res = $res->return; 
        for ($i=0; $i < count($res); $i += 2) { 
            $dorayakiName = $res[$i];
            $amount = (int) $res[$i+1];
            echo $dorayakiName;
            echo $amount;
            echo updateDorayakiStock($dorayakiName, $amount);
        }
    }
    
} catch (Exception $e) {
    $err = $e->getMessage();
}

header("Location: http://localhost:3000/");