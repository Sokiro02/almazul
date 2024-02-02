<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtSelRubro=$_POST['txtSelRubro'];
$txtNombreSubRubro = $_POST['txtNombreSubRubro'];
$txtCodSubRubro=$_POST['txtCodSubRubro'];

$EstadoTekMaster=1;

include("Lib/seguridad.php");
$Datos="Se creo un nuevo sub rubro: ".$txtNombreSubRubro." del rubro: ".$txtSelRubro;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);

//Actualización de Datos App

$sql="INSERT INTO t_subrubros (Cod_Subrubro, Rubro_id_rubro, Nom_Subrubro, Subrubro_publicado) VALUES ('".utf8_decode($txtCodSubRubro."','".utf8_decode($txtSelRubro)."','".utf8_decode($txtNombreSubRubro)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:config.php?Mensaje=12&TAB=tabs-3");

 ?>