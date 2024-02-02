<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Bodegas.php
$UpTxtNombre = strtoupper($_POST['UpTxtNombre']);
$UpTxtCod = strtoupper($_POST['UpTxtCod']);
$UpTxtUsuario = strtoupper($_POST['UpTxtUsuario']);
$UpTxtCiudad = strtoupper($_POST['UpTxtCiudad']);
$UpTxtDir = strtoupper($_POST['UpTxtDir']);
$UpTxtCorreo = strtoupper($_POST['UpTxtCorreo']);
$UpTxtTel = strtoupper($_POST['UpTxtTel']);
$UpTxtCelular = strtoupper($_POST['UpTxtCelular']);
$TxtEditProv=$_POST['TxtEditProv'];

$EstadoTekMaster=1;

//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_bodegas SET Cod_Bodega='".utf8_decode($UpTxtCod)."', Nom_Bodega='".utf8_encode($UpTxtNombre)."', Usuario_Encargado='".utf8_decode($UpTxtUsuario)."', Dir_Bodega='".utf8_decode($UpTxtDir)."', Tel_Bodega='".utf8_decode($UpTxtTel)."', Cel_Bodega='".utf8_decode($UpTxtCelular)."', Correo_Bodega='".utf8_decode($UpTxtCorreo)."' WHERE Id_Bodega='".$TxtEditProv."'");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    include("Lib/seguridad.php");
    $Datos="Se modifico el taller con el codigo: ".$UpTxtCod." y el nombre ".$UpTxtNombre;
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);
}

header("location:Bodegas.php?Mensaje=2");


 ?>