<?php

session_start();
require '../../functions.php';

if (!isset($_SESSION["login1"]) ) {
    header("location:../User/login.php");
    exit;
}

$id = $_GET["id"];

if (hapus_kategori($id) > 0) {
    echo "<script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'kategori.php';
        </script>";
} else {
    echo "<script>
            alert('Data Gagal Di Hapus');
            document.location.href = 'kategori.php';
        </script>";
}

?>