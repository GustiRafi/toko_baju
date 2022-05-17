<?php

session_start();

require '../functions.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Detail Transaksi</title>
</head>

<body>

    !-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand"><b>FASSEN</b></a>
        </div>
    </nav>

    <div class="container mt-5">

        <?php if (!isset($_COOKIE["id_produk"])){ ?>
        <div class="alert alert-info text-center" role="alert">
            <h4><b>Terima kasih telah berbelanja di FASSEN</b></h4>
            <!-- <p>Total Harga yang harus anda bayar adalah Rp. -->
                <!-- <?php //echo number_format($_COOKIE['total_harga'],2,',','.' ) ?> </p> -->
            <?php //var_dump($_COOKIE['total_harga']); ?>
            <h6>Pembayaran di lakukan di luar website, Toko Baju akan menghubungimu lewat whatsapp</h6>
            <a href="kembali.php"><button class="btn btn-outline-success">Kembali</button></a>
        </div>
        <?php } else if (isset($_COOKIE["id_produk"])) { ?>
        <?php
                $id = $_COOKIE["id_produk"];

                $transaksi = query(" SELECT * FROM transaksi LEFT JOIN produk USING(id_produk) WHERE  id_produk = $id ")[0];
                
            ?>
        <div class="alert alert-info text-center" role="alert">
            <h4><b>Terima kasih telah berbelanja di toko baju</b></h4>
            <p>Total Harga yang harus anda bayar adalah Rp.
                <?php echo number_format($transaksi['total_harga'],2,',','.' ) ?> </p>
            <h6>Pembayaran di lakukan di luar website, Toko Baju akan menghubungimu lewat whatsapp</h6>
            <a href="kembali.php"><button class="btn btn-outline-success">Kembali</button></a>
        </div>
        <?php } ?>

    </div>


    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>