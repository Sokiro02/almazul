<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtSelRubro=$_POST['txtSelRubro'];
$txtNombreSubRubro = $_POST['txtNombreSubRubro'];
//$txtCodSubRubro=$_POST['txtCodSubRubro'];

$EstadoTekMaster=1;

//Actualización de Datos App

$sql=("INSERT INTO t_subcategorias_insumos (Categoria_Id_Categoria_Insumo, Nom_SubCategoriaIns, Subcategoria_Insumo_Publicada) VALUES ('".utf8_decode($txtSelRubro)."','".utf8_decode($txtNombreSubRubro)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:insumos.php?Mensaje=12&TAB=tabs-3");

 ?>