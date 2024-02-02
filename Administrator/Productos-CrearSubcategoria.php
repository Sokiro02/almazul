<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreArea = strtoupper($_POST['txtNombreArea']);
$txtDescArea=strtoupper($_POST['txtDescArea']);

$EstadoTekMaster=1;

//Actualización de Datos App

$sql="INSERT INTO t_subcategoria_producto (Cod_SubCat_Producto,Nom_SubCat_Producto,SubCat_Producto_Publicada) VALUES ('".utf8_decode($txtDescArea."','".utf8_decode($txtNombreArea)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Productos-Categoria.php?Mensaje=4&TAB=tabs-2");

 ?>