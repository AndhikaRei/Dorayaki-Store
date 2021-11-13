<?php 
require_once __DIR__."/api/dorayaki/soapGetAllDorayakiName.php";

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
				<?php if (isset($err)):?>
					<div class="alert-error">
						<span class="alert-close" onclick="this.parentElement.style.display='none';">
							<i class="fas fa-times"></i>
						</span>
						<?= $err ?>
					</div>
				<?php endif;?>
				<div class="content-body" id="content-body">
					<form action="?" enctype="multipart/form-data" method="POST" id="form-create">
						<div class="form-divider" style="padding-top: 0rem;">
							<label for="name" class="form-label">Nama</label>
							<select type="text" class="form-input" id="name" name="name"  aria-describedby="name" placeholder="Pilih nama varian">
								<?php if (isset($dorayakiName)):?>
									<?php foreach ($dorayakiName->return as $doraSingleName):?>
										<option value="<?= $doraSingleName ?>"><?= $doraSingleName ?></option>
									<?php endforeach; ?>
								<?php endif;?>
							</select>
						</div>
						<div class="form-divider">
							<label for="photo" class="form-label">Gambar</label>
							<input type="file" accept="image/*" class="form-input" id="photo" name="photo" aria-describedby="photo" placeholder="Masukkan foto dorayaki" required>
							<img id="photo-dorayaki" width="280" height="380" class="img-dorayaki" hidden>
						</div>
						<div class="form-divider">
							<label for="description" class="form-label">Deksripsi</label>
							<textarea class="form-input" id="description" name="description" aria-describedby="description" placeholder="Masukkan deskripsi dorayaki" required> </textarea>
						</div>
						<div class="form-divider">
							<label for="price" class="form-label">Harga</label>
							<input type="number" min="0" class="form-input" id="price" name="price" aria-describedby="price" placeholder="Masukkan harga dorayaki" required>
						</div>
						<input type="hidden" value="0" id="stock" name="stock">
						<div class="form-button">
							<button type="submit" class="btn-add" id="add-variant">Tambah varian</button>
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
		<script src="./static/scripts/variant-add.js"></script>
	</body>

</html>