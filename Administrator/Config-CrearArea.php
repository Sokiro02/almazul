<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreArea = $_POST['txtNombreArea'];
$txtDescArea=$_POST['txtDescArea'];

$EstadoTekMaster=1;

include("Lib/seguridad.php");
$Datos="Se creo una nueva area: ".$txtNombreArea." Desc: ".$txtDescArea;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

//Actualización de Datos App

$sql="INSERT INTO t_areas (Desc_Area,Nom_Area,Area_Publicada) VALUES ('".utf8_decode($txtDescArea."','".utf8_decode($txtNombreArea)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:config.php?Mensaje=16&TAB=tabs-6");

 ?>