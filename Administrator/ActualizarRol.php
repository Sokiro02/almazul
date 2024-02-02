<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$TxtIdRol = $_POST['TxtIdRol'];
$TxtNomRol=$_POST['TxtNomRol'];
$TxtDescRol=$_POST['TxtDescRol'];
$TxtActualizar = $_POST['TxtActualizar'];
$TxtEditar = $_POST['TxtEditar'];
$TxtEliminar = $_POST['TxtEliminar'];
$TxtInsertar = $_POST['TxtInsertar'];
$TxtVer = $_POST['TxtVer'];


//Validación de Checkbox
if ($TxtActualizar==1) {
	$ValorActualizar=1;
}
else
{
	$ValorActualizar=0;
}
//Validación de Checkbox
if ($TxtEditar==1) {
	$ValorEditar=1;
}
else
{
	$ValorEditar=0;
}
//Validación de Checkbox
if ($TxtEliminar==1) {
	$ValorEliminar=1;
}
else
{
	$ValorEliminar=0;
}
//Validación de Checkbox
if ($TxtInsertar==1) {
	$ValorInsertar=1;
}
else
{
	$ValorInsertar=0;
}
//Validación de Checkbox
if ($TxtVer==1) {
	$ValorVer=1;
}
else
{
	$ValorVer=0;
}


//Actualización de Datos App

$sql ="UPDATE t_rol_usuario SET Descrip_Rol='".utf8_decode($TxtDescRol)."',Nombre_Rol='".utf8_decode($TxtNomRol)."', Actualizar_TekMaster='".utf8_decode($ValorActualizar)."', Editar_TekMaster='".utf8_decode($ValorEditar)."', Eliminar_TekMaster='".utf8_decode($ValorEliminar)."', Insertar_TekMaster='".utf8_decode($ValorInsertar)."' , Ver_TekMaster='".utf8_decode($ValorVer)."' WHERE Id_Rol='".$TxtIdRol."'";  
$result = $conexion->query($sql);

header("location:config.php?Mensaje=12&TAB=tabs-2");
 ?>