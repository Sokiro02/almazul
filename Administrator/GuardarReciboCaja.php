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

// Variables de  CrearVenta.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$ReciboCajaAnticipo=$_POST['ReciboCajaAnticipo'];
$ValorTotal=$_POST['ValorTotal'];
$ValorSubtotal=$_POST['ValorSubtotal'];
$ValorIva=$_POST['ValorIva'];
$VentaTienda=$_POST['VentaTienda'];
$ClienteSel=$_POST['TxtClientes'];
$TxtTipoVenta=$_POST['TxtTipoVenta'];
$SumaPagos=$_POST['TxtSumaPagos'];
$TxtVerificaValor=$_POST['TxtVerificaValor'];




if ($ClienteSel=="") {
	header("location:index-ventas.php?Mensaje=555");
}

if ($TxtVerificaValor=="1") {
	header("location:index-ventas.php?Mensaje=556");
	
}
else
{

	// Ciclo de Registro de Ingresos traído de pedidos

foreach($_POST['TxtIdPago'] as $index => $nf) {

    $Codigo=$nf;
    $Monto=($_POST['TxtValorPago'][$index]);
    $TxtTipoPago=($_POST['TxtTipoPago'][$index]);
    $TxtVoucherPago=($_POST['TxtVoucherPago'][$index]);
    $ConceptoVenta=utf8_decode("ANTICIPO A PEDIDO");
    $EstadoIngreso=2;



 $sql=("INSERT INTO t_ingresos(Cod_Recibo_Caja, Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso,Estado_Ingreso) VALUES ('".$ReciboCajaAnticipo."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".$TxtTipoPago."','".utf8_decode($TxtVoucherPago)."','".utf8_decode($Monto)."','".utf8_decode($ClienteSel)."','".utf8_decode($VentaTienda)."','".utf8_decode($ConceptoVenta)."','".$EstadoIngreso."');");
 echo($sql);
$result = $conexion->query($sql);


    }

    // Actualización del Consecutivo de Pedidos
$sql=("UPDATE t_config_tienda SET Consecutivo_ReciboCaja='".$ReciboCajaAnticipo."' WHERE Tienda_Id_Tienda='".$VentaTienda."'");
echo($sql);
$result = $conexion->query($sql);


$sql=("DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."';");
echo($sql);
$result = $conexion->query($sql);


header("location:Pdf_ReciboCajaInmediato.php?AbonoCliente=".$ReciboCajaAnticipo."&latienda=".$VentaTienda."");

}




 ?>

