<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreArea = $_POST['txtNombreArea'];

//Actualización de Datos App

$sql=("INSERT INTO t_tallas (Nom_Talla) VALUES ('".utf8_decode($txtNombreArea)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Productos-Categoria.php?Mensaje=5&TAB=tabs-3");

 ?>