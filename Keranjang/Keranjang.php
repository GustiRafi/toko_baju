<?php

session_start();

require '../functions.php';

if ( !isset($_SESSION["login"]) ){
    $id = $_SESSION["user"];

    $produk2 =mysqli_query($conn,"SELECT * FROM Keranjang2 LEFT JOIN produk USING(id_produk) WHERE cookie_pelangan = $id ");

}

$total_belanja = 0;

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $produk = query("SELECT * FROM Keranjang LEFT JOIN produk USING(id_produk) WHERE id_pelangan = $id_pelanggan  ORDER BY id_keranjang DESC ");
    $isi_data = mysqli_query($conn,"SELECT * FROM Keranjang LEFT JOIN produk USING(id_produk) WHERE id_pelangan = $id_pelanggan  ORDER BY id_keranjang DESC ");

    $jumlah= mysqli_query($conn,"SELECT COUNT(*)  FROM keranjang WHERE id_pelangan = $id_pelanggan ");
    $jumlahproduk =mysqli_fetch_array($jumlah)[0];
}

if(isset($_POST["chekout"])) {
    header("location:isi_data.php");
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
    <title>Keranjang Belanja</title>
</head>

<body>
    <script src="../js/jquery-3.6.0.min.js"></script>



    <script type="text/javascript" src="../js/bootstrap.js"></script>


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


    <div class="container mt-5">
        <?php if ( !isset($_SESSION["login"]) ){ ?>
        <?php while($row = mysqli_fetch_assoc($produk2)){?>
        <h2><?php echo $row['nama_produk'] ?></h2>
        <?php } ?>
        <?php }?>

        <?php if ( isset($_SESSION["login"]) ){ ?>
        <?php if(mysqli_num_rows($isi_data) <= 0){ ?>

        <div class="pt-4">
            <div class="mt-4 alert alert-info" role="alert">
                Belum Ada Barang Yang Di Masukan
            </div>
        </div>

        <?php } else{?>
        <h1 class="pt-4 text-primary"><b> KERANJANG BELANJA </b></h1>
        <h3><?php echo $jumlahproduk ?> Produk</h3>

        <?php  foreach($produk as $row){?>
        <?php
        //error_reporting(0);
        
                $harga=$row["harga"];
                $jumlah =$row["jumlah"];
                $total_harga = $harga * $jumlah;
                $total_belanja += $total_harga ;

        ?>

        <div id="load_cart">
            <script>
            // $("#document").ready(function() {

            //     //event ketika tambah di klik
            //     $("#tambah").on('click', function() {
            //         $('#load_cart').load('../ajax/load_cart.php?id_keranjang=' + $('#id_keranjang')
            //             .val())
            //     });

            // });
            // 
            </script>
            <div class="row g-0 position-relative mt-3 rounded rounded-3 shadow-lg">
                <div class="col-md-3 p-4 ">
                    <img src="../img/<?php echo $row['gambar'] ?>" class="rounded rounded-3 w-100">
                </div>
                <div class="col-md-3 mt-3 px-2">
                    <h2><?php echo $row['nama_produk'] ?></h2>
                    <p>Harga : Rp. <?php echo number_format($row['harga'],2,',','.' ) ?></p>
                    <p>Jumlah : <?php echo $row['jumlah'] ?></p>
                    <p>Ukuran : <?php echo $row["ukuran"] ?></p>
                    <p> Catatan : <?= $row["catatan"]?></p>
                    <p>Total Harga : Rp. <?php echo number_format( $row["total_harga"],2,',','.' ) ?></p>
                </div>
                <div class="col-md-3 mt-3">
                    <div class="d-flex px-2">
                        <!-- <h4>
                            <form action="" method="post" class="me-3">
                                <input type="hidden" name="id_keranjang" id="id_keranjang"
                                    value="<?php ///echo $row['id_keranjang'] ?>">
                                <button type="submit">
                                </button>
                                <i class=" bi bi-plus-square-fill text-success" class="<?//= $row['id_keranjang'] ?>"
                                    id="tambah">Tambah</i>
                            </form>
                        </h4> -->
                        <h4>
                            <a href="Hapus.php?id_keranjang=<?php echo $row['id_keranjang'] ?>"
                                class="text-decoration-none" onclick="
            return confirm('Yakin ingin menghapus Produk dari kerenjang')">
                                <i class="bi bi-trash-fill text-danger w-100 h-100">Hapus</i>
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <h3 class="mt-3"><b> TOTAL BELANJAAN : Rp. <?php  echo number_format($total_belanja,2,',','.' ) ?></b></h3>
        <p class="text-danger">Biaya Tersebut belum termasuk biaya kirim / (ongkir)</p>
        <form action="" method="post">
            <button type="submit" class="btn btn-outline-primary mb-3" name="chekout"><i
                    class="bi bi-cart-check-fill me-2"></i>Check
                Out</button>
        </form>

        <?php } ?>

        <?php } ?>
    </div>


</body>

</html>