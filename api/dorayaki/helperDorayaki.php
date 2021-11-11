<?php
// Import.
require_once __DIR__."/../../db/config.php";

/**
 * dorayakiPayloadValidation is a function to check that all request payload are not null, not 
 * empty, and type must be valid. Used for creating new data.
 * @return boolean indicating valid or not.
 */ 
function dorayakiPayloadValidation(){
    // Validate existence.
    if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['price']) 
        || !isset($_FILES['photo']) || !isset($_POST['stock'])){
        return false;
    }    

    // Validate emptyness.
    if ($_POST['name'] == "" || $_POST['description'] == "" || $_POST['price'] =="" 
        || $_FILES['photo'] == ""||$_FILES['photo']['tmp_name'] == "" || $_POST['stock'] == ""){
        return false;
    }

    // Validate type.
    if (!is_numeric(($_POST['price'])) || !is_numeric($_POST['stock'])){
        return false;
    }

    return true;
}

/**
 * dorayakiPayloadValidationUpdate is a function to check that all request payload are not null, 
 * not empty, and type must be valid. Used for updating existing data.
 * @return boolean indicating valid or not.
 */ 
function dorayakiPayloadValidationUpdate(){
    // Validate existence.
    if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['price']) 
        ||!isset($_POST['id']) || !isset($_POST['stock'])){
        return false;
    }    

    // Validate emptyness.
    if ($_POST['name'] == "" || $_POST['description'] == "" || $_POST['price'] =="" 
        || $_POST['id']=="" || $_POST['stock'] == ""){
        return false;
    }

    // Validate type.
    if (!is_numeric(($_POST['price'])) || !is_numeric($_POST['stock']) || !is_numeric($_POST['id'])){
        return false;
    }

    return true;
}
/**
 * getDorayakiByID is a shorthand function to get dorayaki by it's id.
 * @param integer $id : id of dorayaki.
 * @return array|null : array containing single dorayaki or null if not exist.
 */
function getDorayakiById($id){
    global $db;

    // Fetch from database.
    $statement = $db->prepare('SELECT * FROM "Dorayaki" WHERE "id" = ?');
    $statement->bindValue(1, $id);
    $res = $statement->execute();

    // Fetch data as associative array and validate data.
    $data = $res->fetchArray(SQLITE3_ASSOC);
    if (!$data){
       return null;
    }
    return $data;
}

/**
 * updateDorayakiSold is a shorthand function to update dorayaki terjual value.
 * @param integer $id : number of added dorayaki.
 * @param integer $newSold : new sold value of dorayaki.
 * @param integer $newStock : new stock value of dorayaki.
 * @return bool : indicating success update or not.
 */
function updateDorayakiSoldStock($id, $newSold, $newStock){
    global $db;

    // Updating data to database.
    // Prepating query.
    $query = $db->prepare(
        "   UPDATE `Dorayaki` 
            SET `stok`= :stock,
                `terjual`= :terjual
            WHERE
                `id`=:id 
        "
    );
    $query->bindParam(':stock', $newStock);
    $query->bindParam(':terjual', $newSold);
    $query->bindParam(':id', $id);

    // Saving to database and validate the process. 
    $data = $query->execute();
    

    if (!$data || $db->changes()==0) {
	    return false;
    }
    return true;
}
