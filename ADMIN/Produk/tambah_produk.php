<?php

session_start();
require '../../functions.php';

if (!isset($_SESSION["login1"])) {
    header("location:login.php");
    exit;
}

if (isset($_POST["tambah_produk"])) {

    if(tambah_produk($_POST) > 0) {
        echo "<script>
                alert('Data Berhasil DiTambahkan ');
                document.location.href = 'produk.php';
            </script>";
    }else {
        echo "<script>
                alert('Data Gagal DiTambahkan ');
                document.location.href = 'produk.php';
            </script>";
    }
}
$kategori = query("SELECT * FROM kategori ORDER BY id_kategori DESC");


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Data Produk | Fassen </title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">


    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../halaman_admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- LOGO -->
                </div>
                <div class="sidebar-brand-text mx-3">FASSEN</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../halaman_admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Website
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="produk.php" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <span>Data Produk</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="produk.php">Data Produk</a>
                        <a class="collapse-item" href="tambah_produk.php">Tambah Produk</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="../Kategori/kategori.php" data-toggle="collapse"
                    data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <span>Data Kategori</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../Kategori/kategori.php">Data Kategori</a>
                        <a class="collapse-item" href="../Kategori/tambah_kategori.php">Tambahh Kategori</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../Transaksi/transaksi.php">
                    <span>Data Transaksi</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="../Masukan/masukan_web.php">
                    <span>Masukan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <ul>
                        <li class="nav-item dropdown no-arrow  float-end">

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["name_admin"];?></span>
                                <i class="bi bi-person-circle text-secondary"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../user/edit_profil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Edit Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../user/logout.php" onclick="
                return confirm('Yakin akan logout?')">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data Produk</h1>
                    </div>

                    <form action="" class="mt-3" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <input type="text" class="form-control" name="nama_produk" id="nama_produk"
                                placeholder="Nama produk" required>
                        </div>

                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" name="kategori"
                                id="kategori">
                                <option value="">Kategori</option>
                                <?php foreach ($kategori as $row) { ?>
                                <option value="<?php echo $row['id_kategori']; ?>">
                                    <?php echo $row["nama_kategori"] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" name="foto" id="foto" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="harga_produk" id="harga_produk"
                                placeholder="Harga produk" required>
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="ukuran" id="ukuran"
                                placeholder="Ukuran produk" required>
                        </div>

                        <div class="mb-3">
                            <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3"
                                placeholder="deskripsi produk" required>
                            </textarea>
                        </div>

                        <div class="mb-3">
                            <select name="status" class="form-select" aria-label="Default select example" id="status">
                                <option value="">Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary" name="tambah_produk"
                            id="tambah_produk">Tambah
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>


<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>


<script src="../js/sb-admin-2.min.js"></script>


<script src="../vendor/chart.js/Chart.min.js"></script>


<script src="../js/demo/chart-area-demo.js"></script>
<script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>