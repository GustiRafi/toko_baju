<?php

session_start();

require '../functions.php';

$total_belanja=0;

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $produk = query("SELECT * FROM Keranjang LEFT JOIN produk USING(id_produk) WHERE id_pelangan = $id_pelanggan  ORDER BY id_keranjang DESC ");

    $jumlah= mysqli_query($conn,"SELECT COUNT(*)  FROM keranjang WHERE id_pelangan = $id_pelanggan ");
    $jumlahproduk =mysqli_fetch_array($jumlah)[0];
    
    $user = query("SELECT * FROM user_pelanggan LEFT JOIN detail_pelanggan USING(id_pelanggan) WHERE id_pelanggan = $id_pelanggan")[0];

    if(isset($_POST["beli"])) {
        //$_SESSION["total_belanja"] =  $total_belanjaan;
        $total_belanja=0;
        foreach ($produk as $row){
            $harga=$row["harga"];
            $jumlah =$row["jumlah"];
            $total_harga = $harga * $jumlah;
            $total_belanja += $total_harga ;
        }
        setcookie('total_harga', $total_belanja, time()+ 7200 );
        if(ubah($_POST) > 0 ) {
            
            if(check_out($_POST) > 0 ){

                if(riwayat($_POST) > 0 ) {

                    if(hapus_all_cart($_POST) > 0 ) {
                        echo "<script>
                                alert('Transaksi Berhasil');
                                document.location.href = '../Pembayaran/detail_transaksi.php';
                            </script>";
                    } else {
                            echo "<script>
                                    alert('Transaksi Gagal');
                                    document.location.href = '../Pembayaran/error_transaksi.php';
                                </script>";
                    }
                }
            }
    
        }
    
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
    <title>Form Data Diri | Pembelian Produk</title>
</head>

<body>

    <!-- navbar -->
    <?php if ( !isset($_SESSION["login"]) ){ ?>

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
        <h2 class="text-primary pt-4"><b>Alamat Pengiriman</b></h2>
        <?php foreach ($produk as $row){ ?>
        <?php
        
        $harga=$row["harga"];
        $jumlah =$row["jumlah"];
        $total_harga = $harga * $jumlah;
        $total_belanjaan = $total_belanja += $total_harga ;

        ?>
        <?php } ?>

        <div class="alert alert-danger" role="alert">
            <p>Pastikan Mengisi Data dengan benar</p>
        </div>

        <form action="" method="post">
            <div class="input-group mb-3">
                <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan"
                    value="<?=  $_SESSION["id"] ?>" required>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="Nama" id="nama" placeholder="Nama Lengkap" required>
            </div>
            <div class=" input-group mb-3">
                <input type="text" class="form-control" name="no_telp" id="notelp" placeholder="Nomer Telepon" required>
            </div>
            <p class="text-success">Contoh Penulisan alamat : Tegallurung,Gilangharjo,Pandak,Bantul,Yogyakarta</p>
            <div class=" input-group mb-3">
                <input type="text" class="form-control" name="Alamat" id="alamat" placeholder="Alamat Pengiriman"
                    required>
            </div>


            <table class="table table-striped table-responsive w-100 mt-4 ">
                <tr class="bg-success bg-opacity-75 text-white">
                    <th>Barang Yang dibeli</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                </tr>


                <?php foreach($produk as $row){ ?>
                <tr>
                    <td><?= $row["nama_produk"] ?></td>
                    <td><?= $row["jumlah"] ?></td>
                    <td class="text-danger"> Rp. <?= number_format($row["total_harga"],2,',','.' )  ?></tdclas>
                </tr>
                <?php } ?>


            </table>

            <h5 class="mt-3"><b> TOTAL BELANJAAN : Rp. <?php  echo number_format($total_belanjaan,2,',','.' ) ?></b>
            </h5>
            <p class="text-danger">Biaya Tersebut belum termasuk biaya kirim / (ongkir)</p>

            <button type="submit" class="btn btn-outline-primary mb-3" name="beli"
                onclick="confirm( 'Pastikan semua data sudah terisi dengan benar' )"><i
                    class="bi bi-cart-check-fill me-2"></i>Buat
                Pesanan</button>
        </form>
    </div>
    <script type="text/javascript" src="../js/bootstrap.js"></script>

</body>

</html>