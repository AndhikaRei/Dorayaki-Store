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
    <link rel="stylesheet" href="./static/styles/variant-buy.css">
    <title>Buy</title>
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
            <div class="detail-body content-body" id="content-body">
                <div class="detail-image">
                    <img src="" width="280" height="380" class="img-dorayaki" alt="" id="image">
                </div>
                <div class="detail-title">
                    <div>
                        <h2>Varian:<br><span id="name"></span></h2>
                        <p>Rp <span id="price"></span></p>
                        <br>
                        <hr>
                    </div>
                </div>
                <div class="detail-dorayaki">
                    <div class="stok">
                        <p style="width: 90%;" class="card-text">
                            <span class="text-desc">Stok Tersisa</span> <br>
                            <span id="stok"></span>
                        </p>
                    </div>
                    <div class="sold">
                        <p style="width: 90%;" class="card-text">
                            <span class="text-desc">Jumlah terjual </span> <br>
                            <span id="sold"></span>
                        </p>
                    </div>
                    <div class="desc">
                        <p style="width: 95%;" class="card-text">
                            <span class="text-desc">Deskripsi</span> <br>
                            <span id="desc"></span>
                        </p>
                    </div>
                </div>
                <form class="detail-change-stock" id="form-buy" action="">
                    <!-- Hidden Input -->
                    <input type="hidden" name="total_harga" id="total_harga">
                    <input type="hidden" name="dorayaki_id" id="dorayaki_id">
                    <input type="hidden" name="category" id="category" value="pembelian">
                    <input type="hidden" name="dorayaki_nama" id="dorayaki_nama">
                    <input type="hidden" name="jumlah_item" id="jumlah_item">

                    <div class="edit-stock">
                        <input id="buyCount" style="margin-bottom: 0.7rem;" name="buyCount" type="number" min="0" disabled class="input-stock" value="0"> 
                        <label for="buyCount" class="labell">Jumlah Pembelian</label>
                        <button type="button" class="btn-add-stock" name="add-stock" id="add-stock"><i class="fas fa-plus"></i> </button>
                        <button type="button" class="btn-reduce-stock" name="reduce-stock" id="reduce-stock"><i class="fas fa-minus"></i></button>
                    </div>
                    <div class="total-harga">
                        <p style="width: 95%;" class="card-text">
                        <span class="text-desc">Total harga</span> <br> 
                        <span id="total-harga"></span>
                    </p>
                    </div>
                    <div class="edit">
                        <br>
                        <button id="btn-add" class="btn-add">Beli</button>
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
    <script src="./static/scripts/variant-buy.js"></script>
</body>
</html>