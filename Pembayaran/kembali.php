<?php 

setcookie('total_harga', '', time()-1000);
setcookie('id_produk', '', time()-1000);

echo "<script>
        window.location='../Beranda.php';
        </script>";
exit;


?>