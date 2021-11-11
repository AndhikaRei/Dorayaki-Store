<?php 

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

function validateUsername($username) {
  $res = array();

  // Format check
  if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
    $res['status'] = "invalid";
    $res['message'] = "Username harus kombinasi A-Z, a-z, _";
  } else {
    // Unique check
    $db = new SQLite3("../db/dorayaki.sqlite");
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

function register($email, $username, $password, $confirmPassword) {
  $db = new SQLite3("../db/dorayaki.sqlite");

  if ($password == $confirmPassword) {
    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    $query = $db->prepare(
      "INSERT INTO `Akun` (`email`, `username`, `password`) VALUES (:email,:uname,:pwd)"
    );
    $query->bindParam(':email', $email);
    $query->bindParam(':uname', $username);
    $query->bindParam(':pwd', $passwordHashed);

    if ($query->execute()) {
      session_start();
      $_SESSION["username"] = $username;
    }
  }
}
  
$reqData = (json_decode(file_get_contents('php://input'), true));
if (isset($reqData['functionName'])) {
  switch ($reqData['functionName']) {
    case 'validateEmail':
      validateEmail($reqData['email']);
    case 'validateUsername':
      validateUsername($reqData['username']);
    case 'register':
      register($reqData['email'], $reqData['username'], $reqData['password'], $reqData['confirmPassword']);
  }
}

?>