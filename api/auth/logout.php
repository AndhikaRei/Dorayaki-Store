<?php
    if (isset($_POST['logout'])) {
        setcookie("token", "", time() - 3600, "/");
        header("Location: /login.php");
        exit;
    }
?>
