<?php 

function login($username, $password) {
  $res = array();

  $db = new SQLite3("../db/dorayaki.sqlite");

  $query = $db->prepare("SELECT * FROM Akun WHERE username = :username");
  $query->bindParam(':username', $username);

  if ($row = $query->execute()->fetchArray()) {
    // Check password is correct
    if (password_verify($password, $row['password'])) {

      $userId = $row["id"];
      $expireTime = time() + 7200;
      $token = hash("sha256", $userId . $username . time());

      $expireDate = new DateTime();
      $expireDate->setTimestamp($expireTime);
      $expireDate = $expireDate->format('Y-m-d H:i:s');

      $query = $db->prepare(
        "INSERT INTO `Tokens` (`token`, `user_id`, `expire_date`) VALUES (:token,:id,:expDate)"
      );
      $query->bindParam(':token', $token);
      $query->bindParam(':id', $userId);
      $query->bindParam(':expDate', $expireDate);

      if ($query->execute()) {
        setcookie("token", $token, $expireTime, "/");
        $res['status'] = "success";
        $res['message'] = "Login success";
      } else {
        $res['status'] = "error";
        $res['message'] = "User login failed";
      }
    } else {
      $res['status'] = "error";
      $res['message'] = "Username atau password salah";
    }
  } else {
    $res['status'] = "error";
    $res['message'] = "Username atau password salah";
  }
  exit(json_encode($res));
}
  
$reqData = (json_decode(file_get_contents('php://input'), true));
if (isset($reqData['functionName'])) {
  switch ($reqData['functionName']) {
    case 'login':
      login($reqData['username'], $reqData['password']);
  }
}
