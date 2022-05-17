<?php

session_start();

require '../functions.php';

// if ( !isset($_SESSION["beranda"]) ){
//     header("location:../Beranda.php");
//     exit;
// }


$id = $_GET["id"];
$produk=query("SELECT * FROM produk WHERE id_produk = $id")[0];


if(isset($_POST["beli"])) {
    //$_SESSION["id_produk"] = $produk["id_produk"];
    setcookie('id_produk', $produk["id_produk"],time() + 7200);

    if(transaksi($_POST) > 0 ){
        echo "<script>
                document.location.href = 'detail_transaksi.php';
            </script>";
    } else {
        echo "<script>
                alert('Transaksi Gagal');
                document.location.href = 'error_transaksi.php';
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
    <title>Pembelian | <?php echo $produk["nama_produk"] ?></title>
</head>

<body>
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
                        <a class="nav-link" href="all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Keranjang/Keranjang.php"><i
                                class="bi bi-cart-fill me-2"></i>Keranjang
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
    </nav>


    <div class="container mt-5">

        <!-- produk -->
        <div class="pt-5">
            <div class="row g-0 bg-primary position-relative text-light rounded rounded-3 h-auto">
                <div class="col-md-6 mb-md-0 p-md-4 ">
                    <img src="../img/<?php echo $produk['gambar'] ?>" class=" rounded-3 w-100 ">
                </div>
                <div class="col-md-6 p-4 ps-md-0">
                    <h3 class="mt-0"><b><?php echo $produk["nama_produk"]?></b></h3>
                    <p>Rp. <?php echo number_format($produk["harga"],2,',','.' ) ?></p>
                    <p>Tersedia dalam ukuran : <?php echo $produk["ukuran_produk"] ?></p>

                    <div class="row g-0  position-relative mt-3 rounded rounded-3 text-dark ">
                        <h3 class="text-light mt-3 "><b>Data Pembelian</b></h3>
                        <div class="col-md-6 mb-md-0 p-md-4 ">
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="id_produk" id="id"
                                        value="<?php echo $produk["id_produk"] ?>">
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nama_pembeli" id="nama_pembeli"
                                        placeholder="Nama anda " required>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" class="form-control" name="harga"
                                        value="<?php echo $produk['harga'] ?>">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="telepon" id="telepon"
                                        placeholder="No HP" required>
                                </div>

                                <div class="mb-3">
                                    <input type="number" class="form-control" name="jumlah" id="jumlah" value="1"
                                        min="1" max="10" placeholder="Jumlah Produk" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="ukuran" id="ukuran"
                                        placeholder="ukuran Produk" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="Alamat" id="Alamat"
                                        placeholder="Alamat Pengiriman" required>
                                </div>
                                <p class=" text-white">jika tidak ingin memberi catatan pembelian tulis saja "tidak ada"
                                </p>
                                <div class="mb-3">
                                    <textarea name="catatan" class="form-control" id="catatan" rows="3"
                                        placeholder="catatan"></textarea>
                                </div>
                                <button type="submit" name="beli" onclick="
                return confirm('Pastikan data yang anda isi sudah benar !!')" class="btn btn-outline-light">
                                    <i class="bi bi-bag-check-fill"></i>Buat
                                    Pesanan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>