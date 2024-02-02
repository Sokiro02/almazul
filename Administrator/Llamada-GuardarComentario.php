<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Producto-Disponibilidad.php 
$TxtEstado = $_POST['TxtEstado'];
$TxtComentario = $_POST['TxtComentario'];
$TxtLlamadaSel = $_GET['TxtLlamadaSel'];
$TxtIdLlamada = $_POST['TxtIdLlamada'];

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

//Actualización de Datos App

$sql="INSERT INTO t_seguimiento_llamadas(Llamada_Id_llamada, Vendedor_Id_Usuario, Comentario_Llamada, Fecha_Comentario) VALUES  ('".utf8_decode($TxtIdLlamada."','".utf8_decode($IdUser)."','".utf8_decode($TxtComentario)."','".utf8_decode($MarcaTemporal)."')");
//echo($sql);
$result = $conexion->query($sql);

$sql="UPDATE t_llamadas SET Estado_Llamada='".$TxtEstado."' WHERE Id_Llamada='".$TxtIdLlamada."'";
//echo($sql);
$result = $conexion->query($sql);

header("location:LeadsModasof.php?Mensaje=11&LlamadaSel=".$TxtLlamadaSel."");

 ?>