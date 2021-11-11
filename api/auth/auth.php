<?php

/**
 * isLoggedIn is a function to check if user is logged in and valid, 
 * @param SQLite3 $db : sqlite3 database.
 * @return integer id of the logged in user if logged in, 0 if not logged in.
 */ 
function isLoggedIn($db) {
  // Check if there is token cookie
  if (isset($_COOKIE["token"])) {
    $token = $_COOKIE["token"];

    $query = $db->prepare("SELECT * FROM `Tokens` WHERE `token` = :token");
    $query->bindParam(":token", $token);

    // Check if token exists
    if ($row = $query->execute()->fetchArray()) {
      // Check expiry date of token
      if (time() < strtotime($row["expire_date"])) {
        return $row["user_id"];
      } else {
        setcookie("token", "", time() - 3600, "/");
        return 0;
      }
    } else {
      setcookie("token", "", time() - 3600, "/");
      return 0;
    }
  } else {
    return 0;
  }
}

/**
 * isAdmin is a function to check if a user is an admin, 
 * @param SQLite3 $db : sqlite3 database.
 * @param integer $id : user id to be checked.
 * @return boolean indicating if the user is an admin
 */ 
function isAdmin($db, $id) {
  $query = $db->prepare("SELECT * FROM `Akun` WHERE `id` = :id");
  $query->bindParam(":id", $id);

  // Check if user exists
  if ($row = $query->execute()->fetchArray()) {
    return $row["is_admin"] == 1;
  } else {
    return false;
  }
}
