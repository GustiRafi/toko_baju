<?php

session_start();

require '../functions.php';

$id_pelanggan = $_SESSION["kunci"];

$result = mysqli_query($conn, "SELECT * FROM detail_pelanggan WHERE id_pelanggan = '$id_pelanggan' ");


if(isset($_POST["kirim"])){

    $row = mysqli_fetch_assoc($result);
    
    if($_POST["umur"] == $row['umur']){
        
        if($_POST["jenis_kelamin"] == $row["Jenis_Kelamin"]){

            if($_POST["alamat"] == $row["Alamat"]){

                if($_POST["notelp"] == $row["No_telp"]){
                    header("location:reset_password.php");
                }else{
                    $errortlp = true;
                }
            }else {
                $erroralmt = true;
            }
        }else {
            $errorjns = true;
        }
    } else{
        $errortgl = true;
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Reset Password</title>
</head>

<body>

    <div class="container mt-5">
        <h2 class="pb-3 text-primary"><b> Pertanyaan</b></h2>
        <p>Untuk keamanan anda, silahkan jawab pertanyaan berikut dengan benar</p>

        <div id="mt-4">
            <?php if(isset($errortgl)) {?>
            <div class="alert alert-danger" role="alert">
                <p>Umur salah</p>
            </div>
            <?php }; ?>
        </div>
        <div id="mt-4">
            <?php if(isset($errorjns)) {?>
            <div class="alert alert-danger" role="alert">
                <p>Jenis Kelamin salah</p>
            </div>
            <?php }; ?>
        </div>
        <div id="mt-4">
            <?php if(isset($erroralmt)) {?>
            <div class="alert alert-danger" role="alert">
                <p>Alamat salah</p>
            </div>
            <?php }; ?>
        </div>
        <div id="mt-4">
            <?php if(isset($errortlp)) {?>
            <div class="alert alert-danger" role="alert">
                <p>Nomer telepon salah</p>
            </div>
            <?php }; ?>
        </div>

        <form action="" class="mb-3 mt-3" method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-calendar text-white"></i>
                </span>
                <input type="text" class="form-control" name="umur" id="umur" placeholder="umur">
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
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>

    <script src="../js/bootstrap.js"></script>

</body>

</html>