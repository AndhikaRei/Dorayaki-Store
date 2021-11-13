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
if (!dorayakiPayloadValidationUpdate()){
	http_response_code(400);
	$res = ["error" => [ "code" => 400, "message" => "Failed during input validation"]];
	exit(json_encode($res));
}

// Capture request payload.
$id = $_POST['id'];
$deskripsi = $_POST['description'];
$harga = $_POST['price'];

// Logic validation.
if ($harga < 0 ){
	http_response_code(400);
	$res = [ "error" => [ "code" => 400, "message" => "Price must not negative"]];
	exit(json_encode($res));
}

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
$image_filename = $image_filename_old;

// Image validation (IF provided).
if (isset($_FILES['photo']) && $_FILES['photo']!="" && $_FILES['photo']['tmp_name'] != ""){
    // var_dump($_FILES['photo']);
    $image = $_FILES['photo'];
    $test = true;
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
}


// Updating data to database.
// Prepating query.
$query = $db->prepare(
	"   UPDATE `Dorayaki` 
        SET `deskripsi`=:deskripsi, 
            `harga`=:harga, 
            `url_gambar`=:url_gambar
        WHERE
            `id`=:id 
	"
);
$query->bindParam(':deskripsi', $deskripsi);
$query->bindParam(':harga', $harga);
$query->bindParam(':url_gambar', $image_filename);
$query->bindParam(':id', $id);

// Saving to database and validate the process. 
$data = $query->execute();
if (!$data || $db->changes()==0) {
	// Delete the saved dorayaki image.
    if ($image_filename_old != $image_filename){
        unlink($image_filepath);
    }
	http_response_code(500);
	$res = [ "error" => [ "code" => 500, "message" => "Failed when saving to database"]];
	exit(json_encode($res));
}

// Remove old image update successfull and image was changed.
if ($image_filename_old != $image_filename){
    // Delete old file. Make sure not deleting dummy file.
    if (!startsWith($image_filename_old, "dorayaki")){
        unlink($image_filepath_old);
    }
}

http_response_code(200);
$res = ['updated'=> true];
exit(json_encode($res));
