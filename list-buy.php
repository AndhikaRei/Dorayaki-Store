<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
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
                    <h2>My Transaction</h2>
                    <p>Kami menyimpan semua transaksi anda dengan aman!</p>
                </div>
                <!-- Body -->
                <div class="content-body">
                    <div class="table-container">
                        <table class="table-transaksi">
                            <thead>
                                <tr class="table-heading">
                                    <th scope="col" colspan="3">Dorayaki Info</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                </tr>
                            </thead>
                            <tbody id="list_status_item">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <?php include_once __DIR__."/includes/footer.php";?>
        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/7daea7707d.js" crossorigin="anonymous"></script>
        <!-- Core Script -->
        <script src="./static/scripts/auth.js"></script>
        <script src="./static/scripts/list-buy.js"></script>
    </body>

</html>