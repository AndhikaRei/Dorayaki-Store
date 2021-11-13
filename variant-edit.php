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
		<link rel="stylesheet" href="./static/styles/variant-add.css">
		<title>Add Variant</title>
	</head>

	<body>
		<!-- Navbar -->
		<section>
            <?php include_once __DIR__."/includes/navbar.php";?>
		</section>
		<!-- Content -->
		<section class="add-variant">
			<div class="container">
				<!-- Header -->
				<div class="content-header">
					<h2>Tambah Varian</h2>
				</div>
				<!-- Body -->
				
				<div class="content-body" id="content-body">
					<form action="?" enctype="multipart/form-data" method="POST" id="form-edit">
						<div class="form-divider" style="padding-top: 0rem;">
							<label for="name" class="form-label">Nama</label>
							<input type="text" class="form-input" id="name" name="name"  aria-describedby="name" disabled>
						</div>
						<div class="form-divider">
							<label for="photo" class="form-label">Gambar</label>
							<input type="file" accept="image/*" class="form-input" id="photo" name="photo" aria-describedby="photo" placeholder="Masukkan foto baru dorayaki" >
							<img id="photo-dorayaki" width="280" height="380" class="img-dorayaki">
						</div>
						<div class="form-divider">
							<label for="description" class="form-label">Deksripsi</label>
							<textarea class="form-input" id="description" name="description" aria-describedby="description" placeholder="Masukkan deskripsi baru dorayaki" required> </textarea>
						</div>
						<div class="form-divider">
							<label for="price" class="form-label">Harga</label>
							<input type="number" min="0" class="form-input" id="price" name="price" aria-describedby="price" placeholder="Masukkan harga baru dorayaki " required>
						</div>
						<div class="form-divider">
							<label for="stock" class="form-label">Stok</label>
							<input type="number"  class="form-input" id="stock" name="stock" aria-describedby="stock" disabled>
						</div>
						<div class="form-button">
							<button type="submit" class="btn-edit" id="add-variant">Ubah varian</button>
						</div>
					</form>
					
				</div>
			</div>
		</section>

		<?php include_once __DIR__."/includes/footer.php";?>

		<!-- Font Awesome -->
		<script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
		<!-- Core Script -->
		<script src="./static/scripts/auth.js"></script>
		<script src="./static/scripts/variant-edit.js"></script>
	</body>

</html>