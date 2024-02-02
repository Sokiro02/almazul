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

$UpTxtCiudad = strtoupper($_POST['UpTxtCiudad']);
$UpTxtDir = strtoupper($_POST['UpTxtDir']);
$UpTxtTel = strtoupper($_POST['UpTxtTel']);
$UpTxtCelular = strtoupper($_POST['UpTxtCelular']);
$TxtEditProv=$_POST['TxtEditProv'];

$EstadoTekMaster=1;

//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_tiendas SET Cod_Tienda='".utf8_decode($UpTxtCod)."', Nom_Tienda='".utf8_encode($UpTxtNombre)."', Dir_Tienda='".utf8_decode($UpTxtDir)."', Tel_Tienda='".utf8_decode($UpTxtTel)."', Cel_Tienda='".utf8_decode($UpTxtCelular)."'  WHERE Id_Tienda='".$TxtEditProv."'");
//echo($sql);
$result = $conexion->query($sql);

header("location:Tiendas.php?Mensaje=2");


 ?>