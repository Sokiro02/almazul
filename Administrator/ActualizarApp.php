<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 
$txtNombre = $_POST['txtNombre'];
$TxtFooter = $_POST['TxtFooter'];
$TxtEmail = $_POST['TxtEmail'];
$TxtTiempo = $_POST['TxtTiempo'];
$TxtConsecutivo = $_POST['TxtConsecutivo'];
$TxtFactura=$_POST['TxtFactura'];
$TxtHorasLaborales = $_POST['TxtHorasLaborales'];
$UrlSite = $_POST['UrlSite'];
$UrlFacebook = $_POST['UrlFacebook'];
$UrlInstagram = $_POST['UrlInstagram'];
$UrlTwitter = $_POST['UrlTwitter'];
$TxtTerminos = $_POST['TxtTerminos'];

//Actualización de Datos App

$sql ="UPDATE t_config SET Nom_App='".utf8_decode($txtNombre)."', Horas_Laborales='".utf8_decode($TxtHorasLaborales)."', Footer_App='".utf8_decode($TxtFooter)."' , Correo_App='".utf8_decode($TxtEmail)."' , Tiempo='".utf8_decode($TxtTiempo)."', Url_Web='".utf8_decode($UrlSite)."' , Url_Facebook='".utf8_decode($UrlFacebook)."' , Url_Instagram='".utf8_decode($UrlInstagram)."' , Url_Twitter='".utf8_decode($UrlTwitter)."' , Terminos='".utf8_decode($TxtTerminos)."', Consecutivo='".utf8_decode($TxtConsecutivo)."',Num_Factura='".utf8_decode($TxtFactura)."' WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=1&TAB=tabs-1");

 ?>