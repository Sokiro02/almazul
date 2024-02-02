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

include("Lib/seguridad.php");
$Datos="Se actualizo el nombre del rubro: ".$EditNomRubro;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);


$sql ="UPDATE t_rubros SET Nom_rubro='".utf8_decode($EditNomRubro)."' WHERE Id_Rubro='".$IdRubro."'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=13&TAB=tabs-2");
 ?>