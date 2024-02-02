<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$txtNombreRubro = $_POST['txtNombreRubro'];
$txtCodRubro=$_POST['txtCodRubro'];

$EstadoTekMaster=1;

include("Lib/seguridad.php");
$Datos="Se creo un nuevo rubro: ".$txtNombreRubro;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);


//Actualización de Datos App

$sql="INSERT INTO t_rubros(Cod_Rubro, Nom_Rubro,Rubro_Publicado) VALUES ('".utf8_decode($txtCodRubro."','".utf8_decode($txtNombreRubro)."','".utf8_decode($EstadoTekMaster)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:config.php?Mensaje=11&TAB=tabs-3");

 ?>