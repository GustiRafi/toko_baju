<?php

session_start();

require '../../functions.php';

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $profil = mysqli_fetch_assoc($result);

    $query = mysqli_query($conn,"SELECT * FROM detail_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $data_diri = mysqli_fetch_assoc($query);

    if(isset($_POST["ubah_prof"])){

        if(ubah_profil_pelanggan($_POST) > 0) {
            echo "
            <script>
                alert('Profil Berhasil diubah....!');
                document.location.href = 'edit_profil.php';
            </script>
        ";
        }else {
            echo "
            <script>
                alert('Profil Gagal diubah.....!');
                document.location.href = 'edit_profil.php';
            </script>
        ";
        }
    }

    if(isset($_POST{"ubah_data"})) {

        if(ubah_data_diri($_POST) > 0) {
            echo "
            <script>
                alert('Data Diri Berhasil diubah....!');
                document.location.href = 'edit_profil.php';
            </script>
        ";
        }else {
            echo "
            <script>
                alert('Data Diri Gagal diubah.....!');
                document.location.href = 'edit_profil.php';
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

        <h3 class="mt-4 text-primary"><b>GANTI NAMA/USERNAME</b></h3>

        <form action="" class="mb-3 mt-3" method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-person-fill text-white"></i>
                </span>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama"
                    value="<?php echo $profil["Nama"] ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-person-fill text-white"></i>
                </span>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                    value="<?php echo $profil["Username"] ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-envelope-fill text-white"></i>
                </span>
                <input type="email" class="form-control" name="email" id="email" placeholder="Alamat Email"
                    value="<?php echo $profil["Email"] ?>" required>
            </div>

            <div class="input-group mb-3">
                <button type="submit" class="btn btn-outline-primary" name="ubah_prof"><i
                        class="bi bi-pencil-square me-2"></i>Ubah Profil</button>
            </div>

        </form>

        <?php if(mysqli_num_rows($query) !== 1){ ?>
        <div class="alert alert-danger" role="alert">
            DATA DIRI BELUM DI ISI,SILAHKAN LENGKAPI DATA DIRI
        </div>
        <?php } else{ ?>

        <h3 class="mt-4 text-primary"><b>Data Diri</b></h3>

        <form action="" class="mb-3 mt-3" method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-calendar text-white"></i>
                </span>
                <input type="text" class="form-control" name="umur" id="umur" placeholder="Tanggal Lahir"
                    value="<?php echo $data_diri["umur"] ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-person-fill text-white"></i>
                </span>
                <select name="jenis_kelamin" class="form-select" id="jenis_kelamin">
                    <option value="">Jenis Kelamin</option>
                    <option value="1" <?php echo ($data_diri['Jenis_Kelamin'] == 1 )? 'selected': ''; ?>><i
                            class="bi bi-gender-male me-3"></i>
                        Laki-Laki</option>
                    <option value="2" <?php echo ($data_diri['Jenis_Kelamin'] == 2)? 'selected': ''; ?>><i
                            class="bi bi-gender-female me-3"></i>
                        Perempuan
                    </option>
                </select>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-house-fill text-white"></i>
                </span>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                    value="<?php echo $data_diri["Alamat"] ?>" required>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-telephone-fill text-white""></i>
                </span>
                <input type=" text" class="form-control" name="notelp" id="notelp" placeholder="No HP"
                        value="<?php echo $data_diri["No_telp"] ?>" required>
            </div>

            <div class=" input-group mb-3">
                <button type="submit" class="btn btn-outline-primary" name="ubah_data"><i
                        class="bi bi-pencil-square me-2"></i>Ubah</button>
            </div>

        </form>
        <?php }?>

    </div>


    <script type="text/javascript" src="../../js/bootstrap.js"></script>


</body>

</html>