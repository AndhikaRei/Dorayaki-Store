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
        <link rel="stylesheet" href="./static/styles/list-buy.css">
        
        <title>List Buy</title>
    </head>

    <body>
        <!-- Navbar -->
		<section>
            <?php include_once __DIR__."/includes/navbar.php";?>
		</section>
        <!-- Content -->
        <section class="list-buy">
            <div class="container">
                <!-- Header -->
                <div class="content-header">
                    <h2>Riwayat Perubahan Stock</h2>    
                </div>
                <!-- Body -->
                <div class="list-buy-tab">
                    <div id="list_status_title">
                        <a class="btn-details tablinks" id="default-link">Default</a>
                        <a class="btn-details tablinks" id="search-variant-link">Search by variant</a>
                    </div>
                </div>
                <div class="content-body ">
                    <div id="default" class="tabcontent">
                        <div class="table-container">
                            <h1 class="table-title">
                                Riwayat Perubahan Saya
                            </h1>
                            <br/>
                            <table class="table-transaksi">
                                <thead>
                                    <tr class="table-heading">
                                        <th scope="col" colspan="3">Dorayaki Info</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam</th>
                                    </tr>
                                </thead>
                                <tbody id="list_status_item_default">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="search-variant" class="tabcontent">
                         
                        <div class="table-container">
                            <form  enctype="multipart/form-data" style="margin-bottom: 1.5rem;">
                                <input type="text" class="search-input" id="name-search" name="name" aria-describedby="name" placeholder="Masukkan nama varian" required>
                                <button role="button" type="submit" class="btn-search" disabled style="cursor: default;"><i class="fas fa-2x fa-search"></i></button>
                            </form>
                            <table class="table-transaksi">
                                <thead>
                                    <tr class="table-heading">
                                        <th scope="col" colspan="3">Dorayaki Info</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total Harga</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Diubah Oleh</th>
                                    </tr>
                                </thead>
                                <tbody id="list_status_item_search">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include_once __DIR__."/includes/footer.php";?>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
        <!-- Core Script -->
        <script src="./static/scripts/auth.js"></script>
        <script src="./static/scripts/list-change-stock.js"></script>
    </body>

</html>