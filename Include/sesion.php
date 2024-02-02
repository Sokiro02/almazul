<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
  header("location:index.php");
exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

header("location:index.php?Mensaje=20");
exit;
}
?>