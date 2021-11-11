<?php
require_once __DIR__."/../../db/config.php";
require_once __DIR__."/../auth/auth.php";

// Validate login.
if (!$uid = isLoggedIn($db)) {
	http_response_code(403);
	$res = ["error" => [ "code" => 403, "message" => "Sender is not logged in"]];
	exit(json_encode($res));
}

$query = $db->prepare("SELECT username, is_admin  FROM `Akun` WHERE `id` = :id");
$query->bindParam(":id", $uid);
$res = $query->execute();

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
