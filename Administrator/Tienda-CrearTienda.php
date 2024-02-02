<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];



// Variables de  Admin-Habitación.php
$TxtNombre = strtoupper($_POST['TxtNombre']);
$TxtCod = strtoupper($_POST['TxtCod']);
$TxtCiudad = strtoupper($_POST['TxtCiudad']);
$TxtDir = strtoupper($_POST['TxtDir']);
$TxtTel = strtoupper($_POST['TxtTel']);
$TxtCelular = strtoupper($_POST['TxtCelular']);


$EstadoTekMaster=1;

//Crear Habitación

$sql=("INSERT INTO t_tiendas (Cod_Tienda, Nom_Tienda,  Dir_Tienda, Tel_Tienda, Cel_Tienda,  Ciudad_Id_Ciudad) VALUES ('".utf8_encode($TxtCod)."','".utf8_encode($TxtNombre)."','".utf8_encode($TxtDir)."','".utf8_encode($TxtTel)."','".utf8_encode($TxtCelular)."','".utf8_encode($TxtCiudad)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Tiendas.php?Mensaje=1");


 ?>