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

$TxtFechaAnticipo=$_POST['TxtFechaAnticipo'];

$Valor1=$_POST['demo1'];
$ValorIngresado=FormatoMascara($Valor1);
$TxtMedioPago=$_POST['TxtMedioPago'];
$TxtVoucher=$_POST['TxtVoucher'];
$TxtNumFactura=$_POST['TxtNumFactura'];
$TxtReciboCaja=$_POST['TxtReciboCaja'];
$TxtCliente=$_POST['TxtCliente'];
$TxtTienda=$_POST['TxtTienda'];
$TxtCancela=$_POST['TxtCancela'];

if ($TxtCancela==1) {
	$TipoIngreso= utf8_decode("ABONA Y CANCELA CARTERA N.".$TxtNumFactura."");
	$ActualizarFactura=("UPDATE t_cartera SET Estado_Cartera='".$TxtCancela."' WHERE Id_Cartera='".$TxtNumFactura."'");
	$result=$conexion->query($ActualizarFactura);
}
else
{
	$TipoIngreso= utf8_decode("ABONO A CARTERA N.".$TxtNumFactura."");
}


$ActualizarRecibo=("UPDATE t_config_tienda SET Consecutivo_ReciboCaja='".$TxtReciboCaja."' WHERE Tienda_Id_Tienda='".$TxtTienda."'");
$result=$conexion->query($ActualizarRecibo);


$sql=("INSERT INTO t_ingresos(Cod_Recibo_Caja,Cartera_Id_Cartera, Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso) VALUES ('".$TxtReciboCaja."','".utf8_decode($TxtNumFactura)."','".utf8_decode($TxtFechaAnticipo)."','".utf8_decode($IdUser)."','".utf8_decode($TxtMedioPago)."','".$TxtVoucher."','".$ValorIngresado."','".$TxtCliente."','".$TxtTienda."','".$TipoIngreso."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Clientes-AbonosCartera.php?AbonosCartera=".$TxtNumFactura."&Mensaje=333");
 ?>

