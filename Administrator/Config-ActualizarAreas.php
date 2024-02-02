<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$IdEditArea = $_POST['IdEditArea'];
$EditNomArea=$_POST['EditNomArea'];
$EditDesArea=$_POST['EditDesArea'];
//Actualización de Datos App

include("Lib/seguridad.php");
$Datos="Se actualizo las Areas. Area: ".$EditNomArea." DesArea: ".$EditDesArea;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);


$sql ="UPDATE t_areas SET Desc_Area='".utf8_decode($EditDesArea)."', Nom_Area='".utf8_decode($EditNomArea)."' WHERE Id_Area='".$IdEditArea."'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=15&TAB=tabs-6");
 ?>