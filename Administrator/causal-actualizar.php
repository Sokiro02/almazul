<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Admin-Habitación.php
$UpTxtNombre = strtoupper($_POST['UpTxtNombre']);
$TxtEditProv=$_POST['TxtEditProv'];


//Actualizar Información de Proveedor
// Datos extraídos de Proveedores.php

$sql=("UPDATE t_causales SET nombre_causal='".utf8_decode($UpTxtNombre)."'WHERE id_causal='".$TxtEditProv."'");
//echo($sql);
$result = $conexion->query($sql);

header("location:causales.php?Mensaje=2");


 ?>