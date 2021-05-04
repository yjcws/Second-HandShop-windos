<?php

session_start();
//session_destroy();
unset($_SESSION['AdminInfo']);
echo "<script>top.location.href='../../view/admin/login.php'</script>";
?>
