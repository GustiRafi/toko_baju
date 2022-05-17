<?php

session_start();

require '../functions.php';

if ( isset( $_POST ["cari"] ) ) {
    
    $keyword = $_POST["cari_user"];
    $query = "SELECT * FROM  user_pelanggan
    WHERE Nama=
    '$keyword' OR
    Username = '$keyword' ";

    $user = mysqli_query($conn,$query);
    $users = mysqli_fetch_assoc($user);

    if(mysqli_num_rows($user) == 1){
        $_SESSION["kunci"] = $users["id_pelanggan"];
        header("location:pertanyaan.php");
    } else{
        $error = true;
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
    <title>Lupa Password</title>
</head>

<body>

    <div class="container mt-5">
        <h2 class="pb-3 text-primary"><b> Lupa Password</b></h2>
        <form action="" method="post" class="d-flex pb-4">
            <input type="text" class="form-control me-3" name="cari_user" id="cari_user"
                placeholder="Cari Berdasarkan Username atau Nama" autofocus autocomplete="off" aria-label="Search">
            <button type="submit" class="btn btn-primary" name="cari" id="cari">Cari</button>
        </form>

        <div id="mt-4">
            <?php if(isset($error)) {?>
            <div class="alert alert-danger" role="alert">
                <p>username / nama tidak ditemukan</p>
            </div>
            <?php }; ?>
        </div>
    </div>

    <script src="../js/jquery-3.6.0.min.js"></script>

    <script src="../js/bootstrap.js"></script>

</body>

</html>