<?php

session_start();

require '../functions.php';


$id = $_GET["id_produk"];
$produk=query("SELECT * FROM produk WHERE id_produk = $id")[0];
$komen =query("SELECT * FROM komen WHERE id_produk = $id ORDER BY id_komen DESC");

$jumlah = mysqli_query($conn,"SELECT COUNT(*) FROM transaksi LEFT JOIN produk USING (id_produk) WHERE id_produk = $id");
$jumlah_beli = mysqli_fetch_array($jumlah)[0];

$data_produk = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = $id");


if(isset($_POST["komen"])) {

    if(komen($_POST) > 0) {
        header('location:detail_produk.php?id_produk='.$id);
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
    <title><?php echo $produk["nama_produk"] ?></title>
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

    <?php } ?>

    <?php

    if ( mysqli_num_rows($data_produk) !== 1 ) {

        if(!isset($id)) {
            header('location:../Beranda.php');
        }

    }else {
    
    ?>

    <div class="container mt-5">

        <div class="pt-5">
            <h3><b>Deskripsi Produk</b></h3>
            <div class="row g-0 bg-primary position-relative mt-5 rounded rounded-3 text-light shadow-lg">
                <div class="col-md-6 mb-md-0 p-md-4 text-center">
                    <img class="rounded rounded-3 w-100" src="../img/<?php echo $produk['gambar'] ?>">
                </div>
                <div class="col-md-6 p-2  ps-md-0 mt-3">
                    <h3><b><?php echo $produk["nama_produk"] ?></b></h3>
                    <h5 class="opacity-75">Terjual <?php echo $jumlah_beli; ?> produk</h5>
                    <div id="load_desk">
                        <h6>DESKRIPSI :</h6>
                        <p><?php echo $produk["deskripsi"]?></p>
                        <p>Tersedia dalam ukuran : <?php echo $produk["ukuran_produk"] ?></p>
                        <p>Rp. <?php echo number_format($produk['harga'],2,',','.' );?></p>
                        <a href="https://api.whatsapp.com/send?phone=+6289504753863&text=
                    hai ,saya ingin bertanya tentang  <?php echo $produk['nama_produk'] ;?>,yang saya lihat di Fassen"
                            target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Klik untuk chat penjual via Whatsapp"><button type="submit"
                                class="btn btn-outline-light mb-3"><i class="bi bi-whatsapp me-2"></i>Tanya
                                Penjual</button></a>
                        <div class="d-flex">
                            <a href="../Pembayaran/pembayaran.php?id=<?php echo $produk['id_produk'] ?>"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Klik untuk membeli produk"><button class="btn btn-outline-light"><i
                                        class="bi bi-bag-fill me-2"></i>BELI</button></a>
                            <a href="../Keranjang/jumlah_ukuran.php?id_produk=<?php echo $produk['id_produk']  ?>"
                                data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Klik untuk menambahkan produk ke keranjang"><button type="submit"
                                    class="rounded-6 btn btn-outline-light w-auto ms-2"><i
                                        class="bi bi-cart-plus-fill mx-2"></i>Masukan Ke Keranjang</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row g-0  position-relative mt-5 rounded rounded-3 text-dark shadow-lg" id="load_komen">
            <h3 class="text-primary px-4 mt-4"><b>Beri Komentar</b></h3>
            <div class="col-md-6 mb-md-0 p-md-4 ">
                <!-- form komen -->
                <?php if ( !isset($_SESSION["login"]) ){ ?>
                <div class="alert alert-danger" role="alert">
                    <p class="text-danger"> <i class="bi bi-exclamation-triangle-fill me-2"></i>Anda Harus LOGIN
                        untuk
                        meninggalkan komentar</p>
                </div>
                <?php } else { ?>
                <form action="" method="post" id="form_Comment">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="id_produk" id="id_produk"
                            value="<?php echo $produk['id_produk'] ?>">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" name="nama" id="nama" placeholder="Nama"
                            value="<?php echo $_SESSION['nama']?>" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="isi" id="isi" rows="3" placeholder="Tulis komentar disini"
                            required></textarea>
                    </div>
                    <button class="btn btn-outline-primary" type="submit" name="komen" id="komen"><i
                            class="bi bi-send-fill me-2"></i>komen</button>
                </form>
                <?php } ?>
            </div>


            <!-- isi komen -->
            <h3 class="text-primary px-4 pt-3"><b>Komentar</b></h3>
            <div class="col-md-6 p-2  ps-md-0 mx-2">

                <?php foreach($komen as $row){ ?>
                <div class="border border-primary rounded-3 mt-3 ">
                    <div class="bg-primary text-light rounded-3">
                        <p class="px-2"><b style="font-size: 20px;"><?php echo $row["nama"] ?> </b> | posted on
                            <?php echo $row["tanggal"] ?>
                        </p>
                    </div>
                    <p class="px-2"><?php echo $row["isi_komen"] ?></p>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <?php } ?>

    <script src="../js/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {


        $("#more").on("click", function() {
            $("#load_desk").load("../ajax/load_desk.php?id_produk=" + <?php $produk["id_produk"] ?>)
        });

        //event ketika button komen di klik
        $('#komen').on("click", function() {

            //var data  = $("#form_Comment").serialize();
            var id_produk = $("#id_produk").val();
            var nama = $("#nama").val();
            var isi = $("#isi").val();

            $.ajax({
                type: "POST",
                url: "../ajax/add_komen.php",
                data: {
                    type: "INSERT",
                    id_produk: id_produk,
                    nama: nama,
                    isi: isi
                },
                succes: function() {
                    $("#load_komen").load("../ajax/load_komen.php?id=" + $('#id_produk')
                        .val())
                }
            });
        });
    });
    </script>

    <script type="text/javascript" src="../js/bootstrap.js"></script>

</body>

</html>