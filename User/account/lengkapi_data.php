<?php

session_start();

require '../../functions.php';

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $profil = mysqli_fetch_assoc($result);

    $query =mysqli_query($conn,"SELECT * FROM  detail_pelanggan WHERE id_pelanggan = '$id_pelanggan' ");
    $detail = mysqli_fetch_assoc($query);

    if(isset($_POST["kirim"])){

        if(lengakapi_data($_POST) > 0){
            echo "<script>
                alert('Data Berhasil DiTambahkan ');
                document.location.href = 'profil.php';
            </script>";
        }else {
            echo "<script>
                    alert('Data Gagal DiTambahkan ');
                    document.location.href = 'profil.php';
                </script>";
        }
    }

}


?>


<!DOCTYPE html>
<ht lang="en">

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
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="../../Produk/all-produk.php">Beranda</a>
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
                <a class="navbar-brand"><b> Fassen</b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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

            <?php if(mysqli_num_rows($query) > 1 )  {?>

            <h3 class="mt-4 text-primary"><b> Lengkapi Data Diri</b></h3>

            <form action="" class="mb-3 mt-3" method="post" enctype="multipart/form-data">

                <div class="input-group mb-3">
                    <input type="hidden" class="form-control" name="id_pelanggan" id="id_pelanggan"
                        value="<?php echo $_SESSION["id"]  ?>" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary">
                        <i class="bi bi-calendar text-white"></i>
                    </span>
                    <input type="text" class="form-control" name="umur" id="umur" placeholder=" Umur" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary">
                        <i class="bi bi-person-fill text-white"></i>
                    </span>
                    <select name="jenis_kelamin" class="form-select" id="jenis_kelamin">
                        <option value="">Jenis Kelamin</option>
                        <option value="1"><i class="bi bi-gender-male me-3"></i>Laki-Laki</option>
                        <option value="2"><i class="bi bi-gender-female me-3"></i>Perempuan</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary">
                        <i class="bi bi-house-fill text-white"></i>
                    </span>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text bg-primary">
                        <i class="bi bi-telephone-fill text-white""></i>
                </span>
                    <input type=" text" class="form-control" name="notelp" id="notelp" placeholder="No HP" required>
                </div>

                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-outline-primary" name="kirim"><i
                            class="bi bi-plus-square me-2"></i>kirim</button>
                </div>

            </form>
            <?php }else{ ?>
            <div class="mt-4 text-center alert alert-success" role="alert">
                Data Diri Sudah Lengkap
            </div>
            <?php } ?>
        </div>

        <script src="../../js/bootstrap.js"></script>

    </body>

    </html>