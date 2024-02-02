<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreArea = $_POST['txtNombreArea'];

//Actualización de Datos App

$sql=("INSERT INTO t_colores (Nom_Color) VALUES ('".utf8_decode($txtNombreArea)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Productos-Categoria.php?Mensaje=6&TAB=tabs-4");

 ?>