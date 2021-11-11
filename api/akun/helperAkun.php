<?php
// Import.
require_once __DIR__."/../../db/config.php";

/**
 * getAkunByID is a shorthand function to get akun by it's id.
 * @param integer $id : id of akun.
 * @return array|null : array containing single akun or null if not exist.
 */
function getAkunById($id){
    global $db;

    // Fetch from database.
    $statement = $db->prepare('SELECT * FROM "Akun" WHERE "id" = ?');
    $statement->bindValue(1, $id);
    $res = $statement->execute();

    // Fetch data as associative array and validate data.
    $data = $res->fetchArray(SQLITE3_ASSOC);
    if (!$data){
       return null;
    }
    return $data;
}