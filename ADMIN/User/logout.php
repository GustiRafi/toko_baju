<?php 
session_start();
$_SESSION =[];
session_unset();
session_destroy();

setcookie('yknts', '', time()-3600);
setcookie('owi', '', time()-3600);
setcookie('key12', '', time()-3600);
setcookie('key22', '', time()-3600);

echo "<script>
        window.location='login.php';
        </script>";
exit;

?>