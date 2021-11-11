<?php 
// Import.
require_once __DIR__."/../../db/config.php";
require_once __DIR__."/../auth/auth.php";
require_once __DIR__."/helperDorayaki.php";
require_once __DIR__."/../helper.php";

// Validate login.
if (!$uid = isLoggedIn($db)) {
	http_response_code(403);
	$res = ["error" => [ "code" => 403, "message" => "Sender is not logged in"]];
	exit(json_encode($res));
}

// Process request params (id).
// Id validation.
if (!idParamsValidation()){
	http_response_code(404);
	$res = ["error" => [ "code" => 400, "message" => "Invalid params"]];
	exit(json_encode($res));
}

$id = $_GET['id'];

// Fetch from database.
$statement = $db->prepare('SELECT * FROM "Dorayaki" WHERE "id" = ?');
$statement->bindValue(1, $id);
$res = $statement->execute();

if (!$res){
    http_response_code(500);
	$res = ["error" => [ "code" => 500, "message" => "Failed when searching in database"]];
	exit(json_encode($res));
}

$data = $res->fetchArray(SQLITE3_ASSOC);

if (!$data){
    http_response_code(404);
	$res = ["error" => [ "code" => 404, "message" => "Not found"]];
	exit(json_encode($res));
}

http_response_code(200);
$res = ["data" => $data];
exit(json_encode($res));