<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$AbonoSalida=$_GET['AbonoSalida'];
$Salida=$_GET['Salida'];
if ($AbonoSalida==2) {
	// Primer tipo de pago
$Valor1=$_POST['demo1'];
$ValorIngresado=FormatoMascara($Valor1);
$TxtMedioPago=$_POST['TxtMedioPago'];
$TxtVoucher=$_POST['TxtVoucher'];
$TipoIngreso="Orden";

$Notaenviada=$_POST['valornotasel'];

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



$sql=("INSERT INTO ingreso_temporal_usuario(Tipo_Pago_Temporal, Valor_Pago_Temporal,Voucher, Usuario_Ingreso,Pago_De) VALUES ('".utf8_decode($medioseleccionado)."','".utf8_decode($valoraguardar)."','".utf8_decode($confirmacionvoucher)."','".utf8_decode($IdUser)."','".$TipoIngreso."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:OrdenCliente-Salida.php?Salida=".$Salida."");
}
else{

// Primer tipo de pago
$Valor1=$_POST['demo1'];
$ValorIngresado=FormatoMascara($Valor1);
$TxtMedioPago=$_POST['TxtMedioPago'];
$TxtVoucher=$_POST['TxtVoucher'];
$TipoIngreso="Orden";

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


$sql=("INSERT INTO ingreso_temporal_usuario(Tipo_Pago_Temporal, Valor_Pago_Temporal,Voucher, Usuario_Ingreso,Pago_De) VALUES ('".utf8_decode($medioseleccionado)."','".utf8_decode($valoraguardar)."','".utf8_decode($confirmacionvoucher)."','".utf8_decode($IdUser)."','".$TipoIngreso."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:OrdenCliente.php");
}
 ?>

