<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Producto-Disponibilidad.php 
$TxtCanal = $_POST['TxtCanal'];
$TxtTienda = $_POST['TxtTienda'];
$TxtNombreCliente=$_POST['TxtNombreCliente'];
$TxtCelularCliente=$_POST['TxtCelularCliente'];
$TxtObserva=$_POST['TxtObserva'];
$TxtRefSel=$_POST['TxtRefSel'];
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

$EstadoTekMaster=1;
$Pendiente="Si";

//Actualización de Datos App

$sql="INSERT INTO t_llamadas(Tienda_Id_Tienda, Canal_Lead,Nombre_Lead, Celular_Lead,Fecha_Notificacion, Observacion_Admin, Estado_Llamada,Llamada_Pendiente) VALUES ('".utf8_decode($TxtTienda."','".utf8_decode($TxtCanal)."','".utf8_decode($TxtNombreCliente)."','".utf8_decode($TxtCelularCliente)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($TxtObserva)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($Pendiente)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Producto-Disponibilidad.php?Mensaje=11&RefSel=".$TxtRefSel."");

 ?>