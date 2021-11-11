<?php 

require_once __DIR__."/../../db/config.php";
require_once __DIR__."/auth.php";

if ($id = isLoggedIn($db)) {
  exit(json_encode(["status" => "success", "message" => "User logged in", "id" => $id]));
} else {
  exit(json_encode(["status" => "error", "message" => "User not logged in"]));
}
