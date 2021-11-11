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

// Fetch from database.
// Default case.
$query = 'SELECT * FROM `Dorayaki`';

// Modified case.
// Determines additional parameter, search.
// Used for searching by name or description;

if (isset($_GET['search'])){
	$query .= ' WHERE `nama` LIKE '.'"%'.$_GET['search'].'%" OR `deskripsi` LIKE '.
		'"%'.$_GET['search'].'%"';
}

// Determines additional parameter, sort, must be table field name.
if (isset($_GET['sort'])){
	$query .= ' ORDER BY '.'`'.$_GET['sort'].'`';
	// Determines additional parameter, order, default asc.
	// Available value = asc, desc.
	if (isset($_GET['order'])){
		$query .= ' '.$_GET['order'];
	}
}

// Determines additional parameter, limit, must be integer.
if (isset($_GET['limit'])){
	if (is_numeric($_GET['limit']) && intval($_GET['limit'])>0){
		$query .= ' LIMIT '.$_GET['limit'];
	}
}

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

// Validate if there is a data.
if (count($data)==0){
	http_response_code(404);
	$res = ["error" => [ "code" => 404, "message" => "Not found"]];
	exit(json_encode($res));	
}

// Determines additional parameter, itemsPerPage, must be integer.
// Transforming array for helping pagination more easier.
if (isset($_GET['itemsPerPage'])){
	if (is_numeric($_GET['itemsPerPage'])){
		$data = arrayPaginate($data, $_GET['itemsPerPage']);
	}
}

http_response_code(200);
$res = ["data" => $data];
exit(json_encode($res));