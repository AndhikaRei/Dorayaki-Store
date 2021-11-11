<?php 
// Import.
require_once __DIR__."/../../db/config.php";
require_once __DIR__."/../auth/auth.php";
require_once __DIR__."/helperTransaction.php";
require_once __DIR__."/../helper.php";
require_once __DIR__."/../akun/helperAkun.php";
require_once __DIR__."/../dorayaki/helperDorayaki.php";

// Validate request sender, must be login.
if (!$uid = isLoggedIn($db)) {
	http_response_code(403);
	$res = ["error" => [ "code" => 403, "message" => "Sender is not logged in"]];
	exit(json_encode($res));
}

// Process request payload.

// Input validation.
// Null validation.
if (!transactionPayloadValidation()){
	http_response_code(400);
	$res = ["error" => [ "code" => 400, "message" => "Failed during input validation"]];
	exit(json_encode($res));
}

// Capture request payload.
$akun_id = $uid;
$dorayaki_id = $_POST['dorayaki_id'];
$dorayaki_nama = $_POST['dorayaki_nama'];
$jumlah_item = $_POST['jumlah_item'];
$category = $_POST['category'];
$total_harga = null;
if ($category =="pembelian"){
    $total_harga = $_POST['total_harga'];
}

// Jika proses yang diminta adalah pembayaran maka user haruslah seorang pengguna yang sedang login.
// Jika proses yang diminta adalah pengubahan maka user haruslah seorang admin yang sedang login.
// TLDR:
// Id pengirim request(org yang sedang login) harus sama dengan akun_id yang ada di payload, 
// harus valid user dan rolenya untuk operasi yang dimau.
$isAdmin = isAdmin($db, $akun_id);
if (!$isAdmin && $category =="pengubahan") {
	http_response_code(400);
	$res = ["error" => [ "code" => 400, "message" => "User cannot change stock"]];
	exit(json_encode($res));
}
if ($isAdmin && $category =="pembelian") {
	http_response_code(400);
	$res = ["error" => [ "code" => 400, "message" => "Admin cannot buy Dorayaki"]];
	exit(json_encode($res));
}

// Try to find related Akun and dorayaki.
$dorayaki_ref = getDorayakiById($dorayaki_id);
$akun_ref = getAkunById($akun_id);
if (!$dorayaki_ref || !$akun_ref){
    http_response_code(404);
	$res = ["error" => [ "code" => 404, "message" => "Account or Dorayaki Not found"]];
	exit(json_encode($res));
}

// Try to update stock and sold first.
if ($category =="pembelian"){
    $update = updateDorayakiSoldStock($dorayaki_id, $dorayaki_ref['terjual']+ intval($jumlah_item),
        $dorayaki_ref['stok'] - intval($jumlah_item));
} else {
    $update = updateDorayakiSoldStock($dorayaki_id, $dorayaki_ref['terjual'],
        $dorayaki_ref['stok'] + intval($jumlah_item));
}

if (!$update){
    http_response_code(500);
	$res = ["error" => [ "code" => 500, "message" => "Error when updating on database"]];
	exit(json_encode($res));
}

// Inserting data to database.
// Prepating query.
$query = $db->prepare(
	" INSERT INTO `Transaksi` (
        `akun_id`, `dorayaki_id`, `dorayaki_nama`, `jumlah_item`, `total_harga`, `category`
    ) VALUES (
        :akun_id, :dorayaki_id, :dorayaki_nama, :jumlah_item, :total_harga, :category
)");
$query->bindParam(':akun_id', $akun_id);
$query->bindParam(':dorayaki_id', $dorayaki_id);
$query->bindParam(':dorayaki_nama', $dorayaki_nama);
$query->bindParam(':jumlah_item', $jumlah_item);
$query->bindParam(':total_harga', $total_harga);
$query->bindParam(':category', $category);

// Saving to database and validate the process. 
$data = $query->execute();
if (!$data || !$db->lastInsertRowID()) {
	// Delete the saved dorayaki image.
	http_response_code(500);
	$res = [ "error" => [ "code" => 500, "message" => "Failed when saving to database"]];
	exit(json_encode($res));
}

http_response_code(200);
$res = ["id"=> $db->lastInsertRowID()];
exit(json_encode($res));
