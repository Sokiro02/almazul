<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$DiaActual = date('Y-m-d');


// Primer tipo de pago

$Valor1=$_POST['demo1'];
$IngresoConfirmado=FormatoMascara($Valor1);
$TxtValorCaja=$_POST['TxtValorCaja'];
$TxtObserva=$_POST['TxtObserva'];
$TxtTienda=$_POST['TxtTienda'];
$Apertura=1;


$sql=("INSERT INTO t_registro_caja (Tienda_Id_Tienda, Usuario_Id_Usuario, Valor_Caja, Valor_Confirmado, Fecha_Registro,Dia_Registro, Tipo_Registro, Reporte_usuario) VALUES ('".$TxtTienda."','".$IdUser."','".($TxtValorCaja)."','".($IngresoConfirmado)."','".$TiempoActual."','".$DiaActual."','".$Apertura."','".utf8_decode($TxtObserva)."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:index-ventas.php?Mensaje=123");
 ?>

