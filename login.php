<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Global Header-->
	<?php include_once __DIR__."/includes/header.php";?>

    <!-- CSS -->
    <link rel="stylesheet" href="./static/styles/login.css">
    <title>Login</title>
</head>
<body>


    <!-- Content -->
    <section class="login">
        <div class="container">
            <!-- Body -->
            <div class="login-body">
                <div class="login-title">
                    <div>
                        <h2>Masuk</h2>
                        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
                        <hr>
                    </div>
                </div>
                
                <form class="login-form" action="./api/login.php" method="post">
                    <div class="form-username">
                        <label for="username" class="form-label">Username</label>
                        <input id="input-username" name="username" type=text class="form-input" required>
                        <div id="input-username-message"><br></div>
                    </div>
                    <div class="form-password">
                        <label for="password" class="form-label">Password</label>
                        <input id="input-password" name="password" type=password class="form-input" required>
                        <div id="input-password-message"><br></div>
                    </div>
                    <div class="error-message login-message" id="error-message">

                    </div>
                    <div class="form-btn">
                        <button id="btn-login" href="#" type="submit" class="btn-login" name="login" disabled>Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
    <!-- Core Script -->
    <script src="./static/scripts/auth.js"></script>
    <script src="./static/scripts/login.js"></script>
</body>
</html>