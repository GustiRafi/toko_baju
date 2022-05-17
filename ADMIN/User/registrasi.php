<?php 
require '../../functions.php';


if ( isset( $_POST["register"] ) ) {

    if (registrasi ($_POST) > 0 ) {
        echo "<script>
                alert('Registrasi Berhasil');
            </script>";
        echo " <script>
                window.location='login.php'
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <title>Sign Up | toko </title>
</head>

<body>
    <div class="container-fluid vh-100" style="margin-top:50px">
        <div class="" style="margin-top:50px">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                    <div class="text-center">
                        <h3 class="text-primary">Sign Up</h3>
                    </div>
                    <form action="" method="post">
                        <div class="p-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary">
                                    <i class="bi bi-person-plus-fill text-white"></i></span>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Name"
                                    required htmlspecialchars>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary">
                                    <i class="bi bi-person-plus-fill text-white"></i></span>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" required htmlspecialchars>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i
                                        class="bi bi-key-fill text-white"></i></span>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="password" required htmlspecialchars>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary"><i
                                        class="bi bi-key-fill text-white"></i></span>
                                <input type="password" name="password2" id="password2" class="form-control"
                                    placeholder=" Confirm password " required htmlspecialchars>
                            </div>
                            <button class="btn btn-primary text-center mt-2" type="submit" name="register">
                                Sign Up
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../js/bootstrap.js"></script>

</body>

</html>