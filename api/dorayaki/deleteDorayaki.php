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

// Validate request sender, must be an admin.
if (!isAdmin($db, $uid)) {
	http_response_code(403);
	$res = ["error" => [ "code" => 403, "message" => "Sender is not an admin"]];
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

// Try to capture old data.
$data_old = getDorayakiById($id);
if (!$data_old){
    http_response_code(404);
	$res = ["error" => [ "code" => 404, "message" => "Not found"]];
	exit(json_encode($res));
}
// Set the photo url as old data photo first.
$image_filename_old = $data_old['url_gambar'];
$image_filepath_old = __DIR__."/../../static/images/".$image_filename_old;

// Delete from database.
$statement = $db->prepare('DELETE FROM "Dorayaki" WHERE "id" = ?');
$statement->bindValue(1, $id);
$res = $statement->execute();

$affectedRow = $db->changes();

if ($affectedRow == 0){
    http_response_code(404);
	$res = ["error" => [ "code" => 404, "message" => "Not found"]];
	exit(json_encode($res));
}

// Delete old file. Make sure not deleting dummy file.
if (!startsWith($image_filename_old, "dorayaki")){
	unlink($image_filepath_old);
}


http_response_code(200);
$res = ["deleted" => true];
exit(json_encode($res));