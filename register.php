<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Global Header-->
	<?php include_once __DIR__."/includes/header.php";?>

    <!-- CSS -->
    <link rel="stylesheet" href="./static/styles/register.css">
    <title>Register</title>
</head>
<body>

    <!-- Content -->
    <section class="register">
        <div class="container">
            <!-- Body -->
            <div class="register-body">
                <div class="register-image">
                </div>
                <div class="register-title">
                    <div>
                        <h2>Daftar Sekarang</h2>
                        <p>Sudah punya akun? <a href="login.php">Masuk</a></p>
                        <hr>
                        <div id="demo"></div>
                    </div>
                </div>
                
                <form class="register-form" action="./api/register.php" method="post">
                    <div class="form-email form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="input-email" name="email" type=email class="form-input" required>
                        <div id="input-email-message"><br></div>
                    </div>
                    <div class="form-username form-group">
                        <label for="username" class="form-label">Username</label>
                        <input id="input-username" name="username" type=text class="form-input" required>
                        <div id="input-username-message"><br></div>
                    </div>
                    <div class="form-password form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="input-password" name="password" type=password class="form-input" required>
                        <div id="input-password-message"><br></div>
                    </div>
                    <div class="form-confirm-password form-group">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input id="input-confirm-password" name="confirm-password" type=password class="form-input" required>
                        <div id="input-confirm-password-message"><br></div>
                    </div>
                    <div id="register-error">
                        
                    </div>
                    <div class="form-btn">
                        <button href="#" type="submit" class="btn-register" id="btn-register" name="register" disabled>Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
    <!-- Core Script -->
    <script src="./static/scripts/auth.js"></script>
    <script src="./static/scripts/register.js"></script>
</body>
</html>