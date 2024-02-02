<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Admin-Habitación.php
$UpTxtNombre = strtoupper($_POST['UpTxtNombre']);
$UpTxtNit = strtoupper($_POST['UpTxtNit']);
$UpTxtContacto = strtoupper($_POST['UpTxtContacto']);
$UpTxtDir = strtoupper($_POST['UpTxtDir']);
$UpTxtCorreo = strtoupper($_POST['UpTxtCorreo']);
$UpTxtTel = strtoupper($_POST['UpTxtTel']);
$UpTxtCelular = strtoupper($_POST['UpTxtCelular']);
$UpTxtWhp = strtoupper($_POST['UpTxtWhp']);
$TxtEditProv=$_POST['TxtEditProv'];

$EstadoTekMaster=1;

//Actualizar Información de Proveedor
// Datos extraídos de Proveedores.php

$sql=("UPDATE t_proveedores SET Nom_Prov='".utf8_decode($UpTxtNombre)."', Nit_Prov='".$UpTxtNit."', Dir_Prov='".$UpTxtDir."', Tel_Prov='".$UpTxtTel."', Cel1_Prov='".$UpTxtCelular."', Whp_Prov='".$UpTxtWhp."', Email_Prov='".$UpTxtCorreo."', Contacto_Prov='". utf8_decode($UpTxtContacto)."' WHERE Id_Proveedor='".$TxtEditProv."'");
//echo($sql);
$result = $conexion->query($sql);

header("location:Proveedores.php?Mensaje=2");


 ?>