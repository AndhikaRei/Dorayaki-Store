<?php
require_once __DIR__."/../../db/config.php";
require_once __DIR__."/helperDorayaki.php";
require_once __DIR__."/../helper.php";

// Capture request payload.
$name = $_POST['name'];
$stok = $_POST['amount'];

// Try to capture old data.
$data_old = getDorayakiByName($name);
if (!$data_old){
    http_response_code(404);
	$res = ["error" => [ "code" => 404, "message" => "Not found"]];
	exit(json_encode($res));
}

// Updating data to database.
// Prepating query.
$query = $db->prepare(
	"   UPDATE `Dorayaki` 
        SET `stok`= `stok` + :amount
        WHERE
            `nama`=:nama 
	"
);
$query->bindParam(':amount', $stok);
$query->bindParam(':nama', $name);


// Saving to database and validate the process. 
$data = $query->execute();
if (!$data || $db->changes()==0) {
	http_response_code(500);
	$res = [ "error" => [ "code" => 500, "message" => "Failed when saving to database"]];
	exit(json_encode($res));
}

http_response_code(200);
$res = ['updated'=> true];
exit(json_encode($res));