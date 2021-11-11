<?php 

require_once __DIR__."/../../db/config.php";
require_once __DIR__."/auth.php";

if ($id = isLoggedIn($db)) {
  if (isAdmin($db, $id)) {
    exit(json_encode(["status" => "success", "message" => "User logged in as admin", "id" => $id]));
  } else {
    exit(json_encode(["status" => "error", "message" => "User is not an admin"]));
  }
} else {
  exit(json_encode(["status" => "error", "message" => "User not logged in"]));
}
