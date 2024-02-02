<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
$MyIdTienda=$_SESSION['IdTienda'];
$MiTienda=$_SESSION['nicktienda'];
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

$txtvalor=$_POST['txtvalor'];
$tiendaregistra=$_POST['tiendaregistra'];

$sql=("INSERT INTO t_frecuencia_clientes(fecha_registro,usuario_id_usuario,tienda_id_tienda,valor) VALUES ('".utf8_decode($MarcaTemporal)."','".utf8_decode($IdUser)."','".utf8_decode($tiendaregistra)."','".utf8_decode($txtvalor)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:index-ventas.php");

?>

