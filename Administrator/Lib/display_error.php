<?php
$IdUser=$_SESSION['IdUser'];
if (empty($IdUser)){
    session_start();
}
//error_reporting(E_ALL); 
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", "0"); 
?>
