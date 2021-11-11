<?php
    if (isset($_POST['logout'])) {
        setcookie("token", "", time() - 3600, "/");
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>DoraYummy</title>
		
		<!-- Global Header-->
		<?php include_once __DIR__."/includes/header.php";?>

		<!-- CSS -->
		<link rel="stylesheet" href="./static/styles/index.css">
		<title>Home</title>
	</head>

	<body>
		<!-- Navbar -->
		<section>
            <?php include_once __DIR__."/includes/navbar.php";?>
		</section>
		<!-- Content -->
		<section class="dashboard">
			<div class="container">
				<!-- Header -->
				<h1 class="dashboard-title"><span class="dashboard-title-1">Dora</span><span class="dashboard-title-2">Yummy's</span> Best Seller</h1>
				<!-- Body -->
                <div id="dorayaki-list" class="dorayaki-list">
                </div>
			</div>
		</section>


        <?php include_once __DIR__."/includes/footer.php";?>
		<!-- Font Awesome -->
		<script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
		<!-- Core Script -->
		<script src="./static/scripts/auth.js"></script>
        <script src="./static/scripts/index.js"></script>
	</body>

</html>