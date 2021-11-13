<?php
include_once __DIR__."/../helper.php";
// Make a soap request.
try {
    if (isset($_POST["btn-edit-stock"])){
        $soapClient = new SoapClient('http://localhost:6123/ds/log-request?wsdl');
        $params = array (
            // TODO: Change real url.
            // Endpoint.
            "arg0" => "api/v1/dorayaki/addStock",
            // Dorayakiname
            "arg1" => $_POST["dorayaki_nama"],
            // Amount.
            "arg2" => $_POST["jumlah_item"]
        );
        $res = $soapClient->addLogRequest($params);
        
        if (is_string($res->return)){
            if (startsWith($res->return, "Error")){
                throw new Exception($res->return);
            } else{
                $succ = $res->return;
            }
        }
    }
} catch (Exception $e) {
    $err = $e->getMessage();
}