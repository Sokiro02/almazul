<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


// Primer tipo de pago
$Valor1=$_POST['demo1'];
$ValorIngresado=FormatoMascara($Valor1);

$TxtMedioPago=$_POST['TxtMedioPago'];


$TxtVoucher=$_POST['TxtVoucher'];
$TipoIngreso="Anticipo";


$sql=("INSERT INTO ingreso_temporal_usuario(Tipo_Pago_Temporal, Valor_Pago_Temporal,Voucher, Usuario_Ingreso,Pago_De) VALUES ('".utf8_decode($TxtMedioPago)."','".utf8_decode($ValorIngresado)."','".utf8_decode($TxtVoucher)."','".utf8_decode($IdUser)."','".$TipoIngreso."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:index-ventas.php");
 ?>

