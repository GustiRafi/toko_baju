<?php

require '../functions.php';

$id_produk = htmlspecialchars( $_POST['id_produk']);
$nama = htmlspecialchars($_POST['nama']);
$isi = htmlspecialchars( $_POST['isi']);



$query = "INSERT INTO komen VALUES (
    '','$id_produk','$nama','$isi', current_timestamp())";

mysqli_query($conn,$query);
return mysqli_affected_rows($conn);



?>