<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreRol = $_POST['txtNombreRol'];
$txtDescri = $_POST['txtDescri'];
$ChecEditar = $_POST['ChecEditar'];
$ChecActualizar = $_POST['ChecActualizar'];
$ChecEliminar = $_POST['ChecEliminar'];
$ChecInsertar = $_POST['ChecInsertar'];
$ChecVer = $_POST['ChecVer'];
$EstadoTekMaster=1;

//Validación de Checkbox
if ($ChecEditar==1) {
	$ValorEditar=1;
}
else
{
	$ValorEditar=0;
}
//Validación de Checkbox
if ($ChecActualizar==1) {
	$ValorActualizar=1;
}
else
{
	$ValorActualizar=0;
}
//Validación de Checkbox
if ($ChecEliminar==1) {
	$ValorEliminar=1;
}
else
{
	$ValorEliminar=0;
}
//Validación de Checkbox
if ($ChecInsertar==1) {
	$ValorInsertar=1;
}
else
{
	$ValorInsertar=0;
}
//Validación de Checkbox
if ($ChecVer==1) {
	$ValorVer=1;
}
else
{
	$ValorVer=0;
}

//Actualización de Datos App

$sql="INSERT INTO t_rol_usuario (Descrip_Rol, Nombre_Rol, Estado_TekMaster_Rol,Actualizar_TekMaster, Editar_TekMaster, Eliminar_TekMaster, Insertar_TekMaster, Ver_TekMaster) VALUES ('".utf8_decode($txtDescri."','".utf8_decode($txtNombreRol)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($ValorActualizar)."','".utf8_decode($ValorEditar)."','".utf8_decode($ValorEliminar)."','".utf8_decode($ValorInsertar)."','".utf8_decode($ValorVer)."')");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    include("Lib/seguridad.php");
    $Datos="Se incluyo un nuevo rol de usuario ".$txtNombreRol;
    $Paginas= $_SERVER['PHP_SELF'];
    $seguridad = AgregarLog($IdUser,$Datos,$Paginas);  
}

header("location:config.php?Mensaje=11&TAB=tabs-2");

 ?>