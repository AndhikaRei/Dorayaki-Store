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
    <link rel="stylesheet" href="./static/styles/variant-detail.css">
    <title>Variant Detail</title>
</head>
<body>
    <!-- Navbar -->
    <section>
        <?php include_once __DIR__."/includes/navbar.php";?>
    </section>

    <!-- Content -->
    <section class="detail">
        <div class="container"> 
            <!-- Header -->
            <div class="content-header">
                <h2>Dorayaki</h2>
                <p>Kami menyajikan dorayaki dengan kualitas tinggi!</p>
            </div>
            <!-- Body -->
            <div class="detail-body content-body">
                <div class="detail-image">
                    <img src="" width="280" height="380" class="img-dorayaki" alt="" id="image">
                </div>
                <div class="detail-title">
                    <div>
                        <h2>Varian:<br id="name"></h2>
                        <p id="price">Rp </p>
                        <br>
                        <hr>
                    </div>
                </div>
                
                <div class="detail-dorayaki">
                    <div class="stok">
                        <p style="width: 90%;" class="card-text" id="stok">
                            <span class="text-desc">Stok Tersisa</span> <br>
                        </p>
                    </div>
                    <div class="sold">
                        <p style="width: 90%;" class="card-text" id="sold">
                            <span class="text-desc">Jumlah terjual </span> <br>
                        </p>
                    </div>
                    <div class="desc">
                        <p style="width: 95%;" class="card-text" id="desc">
                            <span class="text-desc">Deskripsi</span> <br>
                        </p>
                    </div>            
                </div>
                <div class="detail-btn">
                    <a role="button" class="btn-edit hidden" id="btn-edit-stock">Ubah stok</a>
                    <a role="button" class="btn-edit hidden" id="btn-edit">Ubah data</a>
                    <a role="button" class="btn-delete hidden" id="btn-delete">Hapus</a>
                    <a role="button" class="btn-add" id="btn-add">Beli</a>
                </div>
            </div>    
        </div>
    </section>

    <?php include_once __DIR__."/includes/footer.php";?>

    <!-- Core Script -->
    <script src="./static/scripts/auth.js"></script>
    <script src="./static/scripts/variant-detail.js"></script>
</body>
</html>