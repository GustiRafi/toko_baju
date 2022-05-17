<?php

session_start();

require '../functions.php';

if(isset($_POST["reset"])){

    $id_pelanggan = $_SESSION["kunci"];

    $newpass = htmlspecialchars($_POST["newpass"]);
    $newpass2 = htmlspecialchars($_POST["newpass2"]);

    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    $row = mysqli_fetch_assoc($result);
 
        if($newpass2 === $newpass) {
            //enskripsi password baru
            $newpass = password_hash($newpass, PASSWORD_DEFAULT);

            //update password di database
            $query = "UPDATE user_pelanggan SET password = '$newpass' WHERE id_pelanggan = $id_pelanggan";
            mysqli_query($conn, $query);

            echo "
            <script>
                alert('Password Berhasil direset....!');
                document.location.href = 'login.php';
            </script>
        ";

        } else {
            $errorcon = true;
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
        <h2 class="pb-3 text-primary"><b>Reset Password</b></h2>

        <form action="" class="mb-3" method="post" enctype="multipart/form-data">

            <div class="input-group mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-lock-fill text-white"></i>
                </span>
                <input type="password" class="form-control" name="newpass" id="newpass" placeholder="Password Baru"
                    required>
            </div>

            <div class="input-group  mb-3">
                <span class="input-group-text bg-primary">
                    <i class="bi bi-lock-fill text-white"></i>
                </span>
                <input type="password" class="form-control" name="newpass2" id="newpass"
                    placeholder="Konfirmasi Password Baru" required>
            </div>
            <div id="mt-4">
                <?php if(isset($errorcon)) {?>
                <div class="alert alert-danger" role="alert">
                    <p>Konfirmasi Password Salah</p>
                </div>
                <?php }; ?>
            </div>

            <div class="input-group  mb-3">
                <button type="submit" class="btn btn-outline-primary" name="reset">RESET</button>
            </div>

        </form>

    </div>


    <script src="../js/jquery-3.6.0.min.js"></script>

    <script src="../js/bootstrap.js"></script>

</body>

</html>