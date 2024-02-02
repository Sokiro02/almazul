<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$TxtPrefijoLinea = $_POST['TxtPrefijoLinea'];
$TxtNomLinea=$_POST['TxtNomLinea'];
$TxtIdLinea=$_POST['TxtIdLinea'];
//Actualización de Datos App

$sql ="UPDATE t_categoria_producto SET Cod_Cat_Producto='".utf8_decode($TxtPrefijoLinea)."', Nom_Cat_Producto='".utf8_decode($TxtNomLinea)."' WHERE Id_Cat_Producto='".$TxtIdLinea."'";  
$result = $conexion->query($sql);

header("location:Productos-Categoria.php?Mensaje=1&TAB=tabs-1");
 ?>