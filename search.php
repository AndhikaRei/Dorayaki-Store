<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>DoraYummy-Search</title>
		
		<!-- Global Header-->
		<?php include_once __DIR__."/includes/header.php";?>

		<!-- CSS -->
		<link rel="stylesheet" href="./static/styles/search.css">
	</head>

	<body>
		<!-- Navbar -->
		<section>
            <?php include_once __DIR__."/includes/navbar.php";?>
		</section>
		<!-- Content -->
		<section class="search">
			<div class="container">
				<!-- Header -->
				<h1 class="error-title" id="error-dorayaki-not-found">Maaf, Dorayaki tidak ditemukan :((</h1>
				<!-- Body -->
                <div id="dorayaki-vertical-list" class="dorayaki-vertical-list">
                </div>
                <div class="pagination-container">
                    <div id="pagination" class="pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                    </div>
                </div>
			</div>
		</section>


        <?php include_once __DIR__."/includes/footer.php";?>
		<!-- Font Awesome -->
		<script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
		<!-- Core Script -->
		<script src="./static/scripts/auth.js"></script>
        <script src="./static/scripts/search.js"></script>
	</body>

</html>