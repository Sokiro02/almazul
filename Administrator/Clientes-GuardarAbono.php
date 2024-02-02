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
$Num_Factura=$_POST['Num_Factura'];
$Notaenviada=$_POST['valornotasel'];



if ($TxtCancela==1) {

	if ($TxtTienda==2) {
		$TipoIngreso= utf8_decode("ABONA Y CANCELA FACTURA N.".$Num_Factura."");
	$ActualizarFactura=("UPDATE t_facturas SET Factura_Paga='".$TxtCancela."' WHERE Num_Factura='".$Num_Factura."'");
	$result=$conexion->query($ActualizarFactura);
	}
else{
	$TipoIngreso= utf8_decode("ABONA Y CANCELA SALIDA NC".$TxtNumFactura."");
	$ActualizarFactura=("UPDATE t_facturas SET Factura_Paga='".$TxtCancela."' WHERE num_consecutivo_sc='".$TxtNumFactura."'");
	$result=$conexion->query($ActualizarFactura);
	}
}
else
{

	if ($TxtTienda==2) {
		$TipoIngreso= utf8_decode("ABONO A FACTURA.".$Num_Factura."");
	}
	else
	{
		$TipoIngreso= utf8_decode("ABONO A SALIDA NC.".$TxtNumFactura."");
	}

	
}


$ActualizarRecibo=("UPDATE t_config_tienda SET Consecutivo_ReciboCaja='".$TxtReciboCaja."' WHERE Tienda_Id_Tienda='".$TxtTienda."'");
$result=$conexion->query($ActualizarRecibo);

// Buscamos el valor de la nota crédito 
if ($Notaenviada<>'') {
    $sql ="SELECT SUM(Total_Devolucion) as TotalDevoluciones,Cliente_Id_Cliente,notacredito_num FROM t_devoluciones WHERE notacredito_num='".$Notaenviada."'";
    //Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $TotalDevoluciones=$row['TotalDevoluciones'];                  
 }
}

}

// Validación si se envía valor de nota crédito u otro medio de pago//


if ($Notaenviada<>0) {
   $valoraguardar=$TotalDevoluciones;
   $medioseleccionado=5;
   $confirmacionvoucher=$Notaenviada;
}
else {
    $valoraguardar=$ValorIngresado;
    $medioseleccionado=$TxtMedioPago;
    $confirmacionvoucher=$TxtVoucher;
}



$sql=("INSERT INTO t_ingresos(Cod_Recibo_Caja,Factura_Cod_Factura,consecutivosc_id_consecutivosc, Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso) VALUES ('".$TxtReciboCaja."','".$Num_Factura."','".utf8_decode($TxtNumFactura)."','".utf8_decode($TxtFechaAnticipo)."','".utf8_decode($IdUser)."','".utf8_decode($medioseleccionado)."','".$confirmacionvoucher."','".$valoraguardar."','".$TxtCliente."','".$TxtTienda."','".$TipoIngreso."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Clientes-AbonosNE.php?AbonosFactura=".$TxtNumFactura."&Mensaje=333&Detienda=".$TxtTienda."");
 ?>

