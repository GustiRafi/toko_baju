<?php 
session_start();
$_SESSION =[];
session_unset();
session_destroy();

setcookie('halo', '', time()-3600);
setcookie('key', '', time()-3600);
setcookie('key1', '', time()-3600);
setcookie('key2', '', time()-3600);

echo "<script>
        window.location='../Beranda.php';
        </script>";
exit;

?>