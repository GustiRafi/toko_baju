<?php

session_start();

require 'functions.php';

$produk=query("SELECT * FROM produk WHERE status_produk = 1  ORDER BY id_produk DESC LIMIT  12");
$kategori = query("SELECT * FROM kategori ORDER BY id_kategori DESC");

//setcookie('coba','halo',time()+60);

if ( !isset($_SESSION["login"]) ){
    
    // setcookie('halo_user', hash("sha256",get_client_ip()),time()+7200);
    // $_SESSION['user'] = $_COOKIE["halo_user"];
    header("location:User/login.php");
    exit;
}

// if ( isset($_SESSION["masuk"]) ){
//     //setcookie('halo_user','',time()-10000);
//     $_SESSION["id"];
// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>FASSEN| BERANDA</title>
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
                        <a class="nav-link active" aria-current="page" href="Beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Keranjang/Keranjang.php"><i class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="User/login.php"><i class="bi bi-door-open-fill me-2"></i>Login</a>
                    </li>
                </ul>
                <form class="d-flex" action="" method="post">
                    <input class="form-control me-2" type="search" name="keyword" id='keyword' autofocus
                        placeholder="Search" autocomplete="off" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit" name="cari" id="cari">Search</button>
                </form>
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
                        <a class="nav-link active" aria-current="page" href="Beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Keranjang/Keranjang.php"><i class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-circle mx-2"></i>
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="User/account/profil.php"><i
                                        class="bi bi-person-circle mx-2"></i>Profil</a>
                            </li>
                            <li><a class="dropdown-item" href="User/account/riwayat.php"><i
                                        class="bi bi-clock-history mx-2"></i>Riwayat</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="User/logout.php" onclick="
                return confirm('Yakin akan logout?')"><i class="bi bi-box-arrow-right mx-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="" method="post">
                    <input class="form-control me-2" type="search" name="keyword" id='keyword' autofocus
                        placeholder="Search" autocomplete="off" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit" name="cari" id="cari">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php } ?>

    <div class="container mt-5">
        <div class="row">
            <!-- slide -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators ">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner shadow-lg ">
                    <div class="carousel-item active mt-4">
                        <img src="icon/baju.jpg" class="d-block w-100">
                    </div>
                    <div class="carousel-item mt-4">
                        <img src="icon/kemeja.jpg" class="d-block w-100">
                    </div>
                    <div class="carousel-item mt-4">
                        <img src="icon/jam.jpg" class="d-block w-100">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- kategori -->
            <div class="col-12">
                <h3 class="mt-5"><b>Kategori</b></h3>
                <div class="col-12 ">
                    <div class="rounded rounded-5 row bg-highlight mb-4">
                        <?php foreach($kategori as $rows) { ?>
                        <div class="col-3 pb-3">
                            <div class="w-100 text-wrap">
                                <a href="Produk/kategori_produk.php?id=<?php echo $rows['id_kategori'] ?>">
                                    <span class="badge bg-primary w-100 h-100 text-wrap">
                                        <p class="fw-normal pt-3"><b><?php echo $rows['nama_kategori'] ?></b></p>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <!-- produk -->
            <h2 class=" my-3 "><b>Terbaru</b></h2>
            <div class=" d-flex flex-wrap justify-content-center " id="load_produk">
                <?php foreach($produk as $row) { ?>
                <div class=" box flex-row bg-highlight mb-4 px-4">
                    <div class="item  " style="height: 450px;">
                        <a style="text-decoration: none;"
                            href="Produk/detail_produk.php?id_produk=<?php echo $row['id_produk'] ?>"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Klik untuk melihat detail produk">
                            <div class="text-center shadow-lg pt-0 mt-0 " style="border-radius: 15px;">
                                <div class="card bg-primary text-white shadow pt-0 mt-0 "
                                    style="width: 18rem; border-radius: 15px;">
                                    <img style="border-radius: 15px; height:300px; width: 18rem;"
                                        src="img/<?php echo $row['gambar'] ?>">
                        </a>
                        <div class="card-body">
                            <h3><b><?php echo $row['nama_produk'] ?></b></h3>
                            <p>Rp. <?php echo number_format($row['harga'],2,',','.' )?></p>
                            <a href="Keranjang/jumlah_ukuran.php?id_produk=<?php echo $row['id_produk']  ?>">
                                <button type="submit" class=" btn btn-outline-light w-100" name="tambah" id="tambah"
                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Klik untuk menambahkan produk ke keranjang" style="border-radius: 15px;"><i
                                        class="bi bi-cart-plus-fill mx-2"></i>Masukan Ke
                                    Keranjang</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
    </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>

    <script>
    $("#document").ready(function() {
        $('#cari').hide();

        //event ketika keyword ditulis
        $('#keyword').on('keyup', function() {
            $('#load_produk').load('ajax/load_produk.php?keyword=' + $('#keyword').val());
        });
    });
    </script>

    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

<footer>

    <div class="text-white bg-dark">
        <div class="container flex-lg-wrap d-flex ">
            <div class="col-4 flex-row mx-2 text-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                        class="bi bi-instagram align-middle pt-4" viewBox="0 0 20 16">
                        <path
                            d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg>
                </div>
                <p class="pt-3">Instragram</p>
                <p class="text-center pt-3">
                    Ikuti kami di instagram
                    @toko_baju
                </p>
            </div>
            <div class="col-3 flex-row mx-2 text-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                        class="bi bi-whatsapp text-center pt-4" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                </div>
                <p class="pt-3">Whatsapp</p>
                <p class="text-center pt-3">
                    Ikuti kami di Whatsapp
                    089787998929
                </p>
            </div>
            <div class="col-4 flex-row mx-2 text-center">
                <div class="text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                        class=" text-center bi bi-facebook pt-4 " viewBox="0 0 16 16" ">
                    <path
                        d=" M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75
                        7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157
                        1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604
                        6.75-3.934 6.75-7.951z" />
                    </svg>
                </div>
                <p class="pt-3">Facebook</p>
                <p class="text-center pt-3">
                    Ikuti kami di facebook
                    @tokoBaju
                </p>
            </div>
        </div>
        <div class="text-center ">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                class="bi bi-house-door-fill text-center pt-4" viewBox="0 0 16 16">
                <path
                    d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
            </svg>
            <p class="pt-3">Alamat</p>
            <p class="pb-3">
                Jl.Samas Km,Tegallurung,Gilangharjo,pandak,Bantul,Yogyakarta
            </p>
        </div>
    </div>

</footer>

</html>