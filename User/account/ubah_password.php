<?php

session_start();

require '../../functions.php';

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $profil = mysqli_fetch_assoc($result);

    if(isset($_POST["ubahpass"])){

        if(ubah_password_pembeli($_POST) > 0){
            echo "
            <script>
                alert('Password Berhasil diubah....!');
                document.location.href = 'ubah_password.php';
            </script>
        ";
        }else {
            echo "
            <script>
                alert('Password Gagal diubah.....!');
                document.location.href = 'ubah_password.php';
            </script>
        ";
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
            <a class="navbar-brand">Toko Baju</a>
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
        <h3 class="mt-4 text-primary"><b>GANTI PASSWORD</b></h3>

        <form action="" class="mb-3" method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-shield-lock-fill text-white"></i>
                </span>
                <input type="password" class="form-control" name="pass" id="pass" placeholder="Password Lama" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-lock-fill text-white"></i>
                </span>
                <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Password Baru"
                    required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-lock-fill text-white"></i>
                </span>
                <input type="password" class="form-control" name="newpass2" id="newpass"
                    placeholder="Konfirmasi Password Baru" required>
            </div>

            <?php if(isset($error)) {?>
            <div class="alert alert-danger" role="alert">
                <p>Konfirmasi password tidak sesuai</p>
            </div>
            <?php }; ?>

            <div class="mb-3">
                <button type="submit" class="btn btn-outline-primary" name="ubahpass"><i
                        class="bi bi-pencil-square me-2"></i>Ubah Password</button>
                <a href="../lupa_password.php" class="text-decoration-none text-danger float-end">Lupa password?</a>
            </div>

        </form>
    </div>

    <script src="../../js/bootstrap.js"></script>

</body>

</html>