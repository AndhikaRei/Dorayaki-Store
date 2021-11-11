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

// Process request payload.

// Input validation.
// Null validation.
if (!dorayakiPayloadValidation()){
	http_response_code(400);
	$res = ["error" => [ "code" => 400, "message" => "Failed during input validation"]];
	exit(json_encode($res));
}

// Capture request payload.
$nama = $_POST['name'];
$deskripsi = $_POST['description'];
$harga = $_POST['price'];
$image = $_FILES['photo'];
$stock = $_POST['stock'];

// Logic validation.
if ($harga < 0 || $stock < 0){
	http_response_code(400);
	$res = [ "error" => [ "code" => 400, "message" => "Price and stock must not negative"]];
	exit(json_encode($res));
}

// Image validation.
$ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
if (!getimagesize($image["tmp_name"]) && $ext != 'jpeg' && $ext != 'jpg'&& $ext != 'png'){
	http_response_code(400);
	$res = [ "error" => [ "code" => 400, "message" => "Invalid image input"]];
	exit(json_encode($res));
}

// Saving uploaded image to server.
$image_dir = __DIR__."/../../static/images/";
$image_filename = strval(time()).".".$ext;
$image_filepath = $image_dir.$image_filename;
if(!move_uploaded_file($image["tmp_name"], $image_filepath)) {
	http_response_code(500);
	$res = [ "error" => [ "code" => 500, "message" => "Failed to upload file!"]];
	exit(json_encode($res));
}

// Inserting data to database.
// Prepating query.
$query = $db->prepare(
	" INSERT INTO `Dorayaki` (`nama`, `deskripsi`, `harga`, `url_gambar`, `stok`) 
		VALUES (:nama, :deskripsi, :harga, :url_gambar, :stok)"
);
$query->bindParam(':nama', $nama);
$query->bindParam(':deskripsi', $deskripsi);
$query->bindParam(':harga', $harga);
$query->bindParam(':url_gambar', $image_filename);
$query->bindParam(':stok', $stock);

// Saving to database and validate the process. 
$data = $query->execute();
if (!$data || !$db->lastInsertRowID()) {
	// Delete the saved dorayaki image.
	unlink($image_filepath);
	http_response_code(500);
	$res = [ "error" => [ "code" => 500, "message" => "Failed when saving to database"]];
	exit(json_encode($res));
}

http_response_code(200);
$res = ["data" => $data, "id"=> $db->lastInsertRowID()];
exit(json_encode($res));
