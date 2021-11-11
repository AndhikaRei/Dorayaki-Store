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

// Fetch from database.
$query = 'SELECT * FROM `Transaksi`';

// Search by user id.
$query .= ' WHERE `akun_id` = '.$uid;

// Sort transaction by time.
$query .= ' ORDER BY date(`tanggal`) ASC, time(`waktu`) ASC';

// Execute query.
$statement = $db->prepare($query);
$res = $statement->execute();

if (!$res){
	http_response_code(500);
	$res = ["error" => [ "code" => 500, "message" => "Failed when searching in database"]];
	exit(json_encode($res));
}

// Initialize empty data.
$data = array();

// Fetch all data.
while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
	$data[] =$row;
}

// For each transaction data, find corresponding user and dorayaki data.
foreach($data as &$row){
	$dorayaki = getDorayakiById($row['dorayaki_id']);
	$user = getAkunById($row['akun_id']);
	
	// Append dorayaki image and price for showcase
	// If corresponding dorayaki data has been deleted then
	// dorayaki price = total_price/item_count (from transaction table);
	// dorayaki photo = user default image-not-found in static images.
	if ($dorayaki){
		$row['url_gambar'] = $dorayaki["url_gambar"]; 
		$row['dorayaki_harga'] = $dorayaki["harga"]; 
	} else {
		$row['url_gambar'] = "image-not-found.png";
		$row['dorayaki_harga'] = $row["total_harga"] / $row["jumlah_item"]; 
	}

	// Append username
	// Actuallly user can't be null because you can't delete user, so it's okay.
	if ($user){
		$row['akun_nama'] = $user["username"];
	} else {
		$row['akun_nama'] = "deleted";
	}
}

http_response_code(200);
$res = ["data" => $data];
exit(json_encode($res));