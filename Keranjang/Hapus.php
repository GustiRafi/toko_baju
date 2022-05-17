<?php

require '../functions.php';

$id_keranjang=$_GET["id_keranjang"];

if (hapus_keranjang($id_keranjang) > 0) {
    echo "<script>
            alert('Produk berhasil di hapus dari keranjang');
            document.location.href = 'Keranjang.php';
        </script>";
} else {
    echo "<script>
            alert('Produk gagal di hapus dari keranjang');
            document.location.href = 'Keranjang.php';
        </script>";
}


?>