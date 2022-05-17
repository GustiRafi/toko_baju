<?php

session_start();

require '../../functions.php';

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $profil = mysqli_fetch_assoc($result);

    // $detail = mysqli_query($conn,"SELECT * FROM detail_pelanggan WHERE id_pelanggan = $id_pelanggan ");
    // $isi_detail = mysqli_num_rows($detail);

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
    <title>Profil | <?php echo $profil["Username"] ?> </title>
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

    <div class="container pt-5">

        <div class="mt-5 bg-primary rounded-3 text-white px-3 pb-3">
            <h2 class="pt-4"><b> SELAMAT DATANG <?php echo $profil["Username"] ?></b></h2>
            <p>Anda bisa memberikan masukan untuk pengembangan WEBSITE ini</p>
            <a href="kirim_masukan.php">
                <button type="submit" class="btn btn-outline-light"><i class="bi bi-envelope-fill me-2"></i>Kirim
                    Masukan</button>
            </a>
        </div>

        <a href="edit_profil.php" class="text-decoration-none ">
            <div class="rounded-3 px-3 pb-3 d-flex mt-4">
                <h1><i class="bi bi-person-circle me-2"></i></h1>
                <h4>Ubah Profil</h4>
            </div>
        </a>
        <a href="ubah_password.php" class="text-decoration-none text-danger">
            <div class="rounded-3 px-3 pb-3 d-flex mt-4">
                <h1><i class="bi bi-lock-fill me-2"></i></h1>
                <h4>Ubah Password</h4>
            </div>
        </a>
        <a href="riwayat.php" class="text-decoration-none text-warning">
            <div class="rounded-3 px-3 pb-3 d-flex mt-4">
                <h1><i class="bi bi-clock-history me-2"></i></h1>
                <h4>Histori Pembelian</h4>
            </div>
        </a>
        <a href="lengkapi_data.php" class="text-decoration-none text-success">
            <div class="rounded-3 px-3 pb-3 d-flex mt-4">
                <h1><i class="bi bi-clipboard-data-fill me-2"></i></i></h1>
                <h4>Lengkapi Data Diri</h4>
            </div>
        </a>

    </div>

    <script type="text/javascript" src="../../js/bootstrap.js"></script>


</body>

</html>