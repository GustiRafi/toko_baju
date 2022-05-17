<?php

session_start();

require '../functions.php';

$id = $_GET["id_produk"];
$produk=query("SELECT * FROM produk WHERE id_produk = $id")[0];

$id_pelanggan =  $_SESSION['id'] ;
$user= query("SELECT * FROM user_pelanggan LEFT JOIN detail_pelanggan USING(id_pelanggan) WHERE id_pelanggan = $id_pelanggan")[0];

if(isset($_POST["tambah"])) {
        
    if(tambah_keranjang($_POST) > 0 ) {
        echo "<script>
                alert('Produk Berhasil Di tambahkan Ke Keranjang');
                window.location='Keranjang.php'
            </script>";
        // header("location:Keranjang.php");
    }else {
        echo "<script>
                alert('Produk gagal Di tambahkan Ke Keranjang');
            </script>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Tambah Ke Keranjang</title>
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
                        <a class="nav-link active" aria-current="page" href="../Produk/all-produk.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Keranjang.php"><i class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../User/login.php"><i class="bi bi-door-open-fill me-2"></i>Login</a>
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
                        <a class="nav-link active" aria-current="page" href="../Beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Keranjang.php"><i class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle mx-2"></i>
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../User/account/profil.php"><i
                                        class="bi bi-person-circle mx-2"></i>Profil</a>
                            </li>
                            <li><a class="dropdown-item" href="../User/account/riwayat.php"><i
                                        class="bi bi-clock-history mx-2"></i>Riwayat</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../User/logout.php" onclick="
        return confirm('Yakin akan logout?')"><i class="bi bi-box-arrow-right mx-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php } ?>

    <div class="container pt-5">

        <h2 class="mt-5 text-primary"><b>Ukuran dan Jumlah Produk</b></h2>

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan"
                    value="<?php echo  $_SESSION['id']  ?>">
            </div>
            <div class="input-group mb-3">
                <input type="hidden" class="form-control" name="id_produk" id="id_produk"
                    value="<?php echo $produk['id_produk'] ?>" required>
            </div>
            <div class="input-group mb-3">
                <input type="hidden" class="form-control" name="nama" id="nama" value="<?php echo  $user['Nama']  ?>">
            </div>
            <div class="input-group mb-3">
                <input type="hidden" class="form-control" name="notelp" id="notelp"
                    value="<?php echo  $user['No_telp']  ?>">
            </div>
            <p class=" text-success">Jumlah Pembelian Produk</p>
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="jumlah" id="jumlah" value="1" min="1" max="10" required>
            </div>

            <p class="text-success">Tersedia dalam ukuran : <?php echo $produk["ukuran_produk"] ?></p>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="ukuran" id="ukuran" placeholder="Ukuran"" required>
            </div>
            <div class=" input-group mb-3">
                <input type="hidden" class="form-control" name="alamat" id="alamat"
                    value="<?php echo  $user['Alamat']  ?>">
            </div>
            <p class=" text-success">jika tidak ingin memberi catatan pembelian tulis saja "tidak ada"</p>
            <div class="mb-3">
                <textarea name="catatan" class="form-control" id="catatan" rows="3" placeholder="catatan"
                    required></textarea>
            </div>
            <div class=" input-group mb-3">
                <input type="hidden" class="form-control" name="harga" id="harga"
                    value="<?php echo $produk['harga']?> ">
            </div>
            <div class="input-group mb-3">
                <button type=" submit" name="tambah" id="tambah" class="btn btn-outline-primary"><i
                        class="bi bi-plus-square me-2"></i>Tambah</button>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="../js/bootstrap.js"></script>

</body>

</html>