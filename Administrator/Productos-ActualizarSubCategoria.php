<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$TxtPrefijoSubCat = $_POST['TxtPrefijoSubCat'];
$TxtNomSubCat=$_POST['TxtNomSubCat'];
$TxtIdSubCat=$_POST['TxtIdSubCat'];
//Actualización de Datos App

$sql ="UPDATE t_subcategoria_producto SET Cod_SubCat_Producto='".utf8_decode($TxtPrefijoSubCat)."', Nom_SubCat_Producto='".utf8_decode($TxtNomSubCat)."' WHERE Id_SubCat_Producto='".$TxtIdSubCat."'";  
$result = $conexion->query($sql);

header("location:Productos-Categoria.php?Mensaje=3&TAB=tabs-2");
 ?>