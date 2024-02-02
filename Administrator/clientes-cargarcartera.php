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

$TxtFechaCartera=$_POST['TxtFechaCartera'];
$TxtCliente=$_POST['TxtCliente'];
$Valor1=$_POST['demo1'];
$ValorIngresado=FormatoMascara($Valor1);
$TxtTienda=$_POST['TxtTienda'];
$EstadoPago=0;


$sql=("INSERT INTO t_cartera(Cliente_Id_Cliente, Fecha_Cartera, Valor_Cartera, Cartera_Id_Usuario, Tienda_Id_Tienda,Estado_Cartera) VALUES ('".$TxtCliente."','".utf8_decode($TxtFechaCartera)."','".$ValorIngresado."','".utf8_decode($IdUser)."','".utf8_decode($TxtTienda)."','".$EstadoPago."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Informe-Cartera.php?Mensaje=333");
 ?>

