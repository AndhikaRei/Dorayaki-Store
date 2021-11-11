<?php 
require_once __DIR__."/../db/config.php";

function validateEmail($email) {
  $res = array();
  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $res['status'] = "valid";
    $res['message'] = "Email valid";
  } else {
    $res['status'] = "invalid";
    $res['message'] = "Format email salah";
  }
  echo json_encode($res);
  exit();
}

function validateUsername($db, $username) {
  $res = array();

  // Format check
  if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
    $res['status'] = "invalid";
    $res['message'] = "Username harus kombinasi A-Z, a-z, _";
  } else {
    // Unique check
    $query = $db->prepare("SELECT * FROM Akun WHERE username = :username");
    $query->bindParam(':username', $username);
    if ($query->execute()->fetchArray()) {
      $res['status'] = "invalid";
      $res['message'] = "Username sudah terdaftar";
    } else {
      $res['status'] = "valid";
      $res['message'] = "Username dapat digunakan";
    }
  }
  echo json_encode($res);
  exit();
}

function register($db, $email, $username, $password, $confirmPassword) {
  $res = array();
  if ($password == $confirmPassword) {
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $query = $db->prepare(
      "INSERT INTO `Akun` (`email`, `username`, `password`) VALUES (:email,:uname,:pwd)"
    );
    $query->bindParam(':email', $email);
    $query->bindParam(':uname', $username);
    $query->bindParam(':pwd', $passwordHashed);

    if ($query->execute()) {
      $userId = $db->lastInsertRowID();
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
        $res['message'] = "Register success";
      } else {
        $res['status'] = "error";
        $res['message'] = "User login failed";
      }
    } else {
      $res['status'] = "error";
      $res['message'] = "User registration failed";
    }
    exit(json_encode($res));
  }
}
  
$reqData = (json_decode(file_get_contents('php://input'), true));
if (isset($reqData['functionName'])) {
  switch ($reqData['functionName']) {
    case 'validateEmail':
      validateEmail($reqData['email']);
    case 'validateUsername':
      validateUsername($db, $reqData['username']);
    case 'register':
      register($db, $reqData['email'], $reqData['username'], $reqData['password'], $reqData['confirmPassword']);
  }
}
