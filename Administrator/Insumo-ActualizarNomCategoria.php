<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$IdRubro = $_POST['IdRubroEdit'];
$EditNomRubro=$_POST['EditNomRubro'];
//Actualización de Datos App

$sql ="UPDATE t_categorias_insumos SET Nom_CategoriaIns='".utf8_decode($EditNomRubro)."' WHERE Id_Categoria_Insumo='".$IdRubro."'";  
$result = $conexion->query($sql);

header("location:insumos.php?Mensaje=13&TAB=tabs-3");
 ?>