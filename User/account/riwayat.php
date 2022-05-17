<?php

session_start();

require '../../functions.php';

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $profil = mysqli_fetch_assoc($result);

    $riwayat = query("SELECT * FROM riwayat LEFT JOIN produk USING(id_produk) WHERE id_pelangan = $id_pelanggan");

}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Riwayat | <?php echo $profil["Username"] ?> </title>
</head>

<body>

    <!-- navbar -->
    <?php if ( !isset($_SESSION["login"]) ){ ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">TOKO BAJU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../Produk/all-produk.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Keranjang/Keranjang.php"><i
                                class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login.php"><i class="bi bi-door-open-fill me-2"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php } else { ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand"><b>FASSEN</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../Beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Keranjang/Keranjang.php"><i
                                class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle mx-2"></i>
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profil.php"><i
                                        class="bi bi-person-circle mx-2"></i>Profil</a>
                            </li>
                            <li><a class="dropdown-item" href="riwayat.php"><i
                                        class="bi bi-clock-history mx-2"></i>Riwayat</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../logout.php" onclick="
        return confirm('Yakin akan logout?')"><i class="bi bi-box-arrow-right mx-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php } ?>
    <div class=" container pt-3">
        <h3 class="mt-5"> <b>Riwayat Belanja</b> </h3>
        <div class=" d-flex flex-wrap mt-5" id="load_produk">
            <?php foreach ($riwayat as $row){ ?>
            <div class=" box flex-row bg-highlight mb-4 px-4">
                <div class="item  " style="height: 450px;">
                    <a style="text-decoration: none;"
                        href="../../Produk/detail_produk.php?id_produk=<?php echo $row['id_produk'] ?>"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Klik untuk melihat detail produk">
                        <div class="text-center shadow-lg pt-0 mt-0 " style="border-radius: 15px;">
                            <div class="card bg-primary text-white shadow pt-0 mt-0 "
                                style="width: 18rem; border-radius: 15px;">
                                <img style="border-radius: 15px; height:300px; width: 18rem;"
                                    src="../../img/<?php echo $row['gambar'] ?>">
                    </a>
                    <div class="card-body">
                        <h3><b><?php echo $row['nama_produk'] ?></b></h3>
                        <p>Rp. <?php echo number_format($row['harga'],2,',','.' )?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    </div>

    <script type="text/javascript" src="../../js/bootstrap.js"></script>


</body>

</html>