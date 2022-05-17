<?php 

session_start();

require '../functions.php';

// cek cookie
if (isset ($_COOKIE['halo']) && isset ($_COOKIE['key']) ) {
    $key1 = $_COOKIE['halo'];
    $key2 = $_COOKIE['key'];

    // ambil username berdasrkan id
    $result = mysqli_query($conn, "SELECT username FROM user_pelanggan WHERE id_pelanggan = $key1");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key2 === hash('sha256', $row["username"])) {
        $_SESSION["login"] = true;

        $user =mysqli_query($conn, "SELECT * FROM user_pelanggan WHERE id_pelanggan = $key1");
        $users = mysqli_fetch_assoc($user);

        $_SESSION['nama'] = $users["Nama"];
        $_SESSION["id"] =  $users["id_pelanggan"];



    }
}

if (isset ($_POST['login'] ) ) {
    
    $username = mysqli_real_escape_string($conn, $_POST["username"]) ;
    $password =  mysqli_real_escape_string($conn, $_POST["pass"]);

    $result = mysqli_query($conn, "SELECT * FROM user_pelanggan WHERE username = '$username' ");
    
    // cek username
    if ( mysqli_num_rows($result) === 1 ) {
        
        // cek password
        $row = mysqli_fetch_assoc($result);
        //$session = mysqli_fetch_object($result);
        if ( password_verify($password, $row["Password"] ) ) {
            //set session
            $_SESSION["login"] = true;
            $_SESSION['nama'] = $row["Nama"];
            $_SESSION["id"] =  $row["id_pelanggan"];

            if (isset ($_POST["remember"]) ) {

                // buat cookie
                setcookie('halo', $row["id_pelanggan"], time()+ 7200 );
                setcookie('key', hash('sha256', $row["Username"]),time()+7200);
            }

            echo " <script>
                    window.location='../Beranda.php'
                </script>";
            exit;
        }else {
            $error = true;
        }
    } else {
        $error = true;
    }
}
if ( isset($_SESSION["login"]) ){
    header("location:../Beranda.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Login | FASSEN</title>
</head>

<body>
    <div class="container-fluid vh-100" style="margin-top:50px">
        <div class="" style="margin-top:50px">
            <div class="rounded d-flex justify-content-center">
                <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                    <div class="text-center">
                        <h3 class="text-primary">Login</h3>
                    </div>
                    <form action="" method="post">
                        <div class="p-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-person-fill text-white" viewBox="0 0 16 16">
                                        <path
                                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                    </svg>
                                </span>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" htmlspecialchars>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-lock-fill text-white" viewBox="0 0 16 16">
                                        <path
                                            d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                                    </svg>
                                </span>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="password"
                                    htmlspecialchars>
                            </div>

                            <?php if(isset($error)) {?>
                            <div class="alert alert-danger" role="alert">
                                <p>username / password salah</p>
                            </div>
                            <?php }; ?>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="remember" name="remember"
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                            <button class="btn btn-primary text-center mt-2" type="submit" name="login">
                                Login
                            </button>
                            <p class="text-center mt-5">Belum punya akun?
                                <a href="registrasi.php">
                                    <span class="text-primary">Sign Up</span>
                                </a>
                            <p class="text-center mt-2">Lupa kata sandi?
                                <a href="lupa_password.php">
                                    <span class="text-primary">Lupa</span>
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>