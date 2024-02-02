<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$TxtIdRol = $_POST['TxtIdRol'];
$TxtSistema = $_POST['TxtPerActividades'];



//Validación de Checkbox
if ($TxtSistema==1) {
	$ValorSistema=1;
}
else
{
	$ValorSistema=0;
}
//Validación de Checkbox
if ($TxtUsuarios==1) {
	$ValorUsuarios=1;
}
else
{
	$ValorUsuarios=0;
}
//Validación de Checkbox
if ($TxtReportes==1) {
	$ValorReportes=1;
}
else
{
	$ValorReportes=0;
}

//Actualización de Datos App

$sql ="UPDATE t_rol_usuario SET Per_Actividades='".utf8_decode($ValorSistema)."' WHERE Id_Rol='".$TxtIdRol."'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=16&TAB=tabs-5");
 ?>