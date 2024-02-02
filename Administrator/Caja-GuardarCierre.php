<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/funciones.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$DiaActual = date('Y-m-d');


// Primer tipo de pago


$Valor1=$_POST['demo2'];
$IngresoConfirmado=FormatoMascara($Valor1);
$TxtValorCaja=$_POST['TxtValorCaja'];
$TxtObserva=$_POST['TxtObserva'];
$TxtTienda=$_POST['TxtTienda'];
$Apertura=2;


$sql=("INSERT INTO t_registro_caja (Tienda_Id_Tienda, Usuario_Id_Usuario,Valor_Confirmado, Fecha_Registro,Dia_Registro,Tipo_Registro, Reporte_usuario) VALUES ('".$TxtTienda."','".$IdUser."','".($IngresoConfirmado)."','".$TiempoActual."','".$DiaActual."','".$Apertura."','".utf8_decode($TxtObserva)."')");
//echo($sql);
$result = $conexion->query($sql);


// $enviadoa="teksystem.co@gmail.com";
// $copiadoa="fredy.gonzalez@teksystem.co";
// $tipocorreo=2;
// $dato1=$IngresoConfirmado;
// $dato2="";
// $dato3="";
// $dato4="";
// Email_Personalizado($enviadoa,$copiadoa,$tipocorreo,$dato1,$dato2,$dato3,$dato4);

header("location:index-ventas.php?Mensaje=124");
 ?>

