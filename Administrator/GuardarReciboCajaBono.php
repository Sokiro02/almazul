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
$TxtBono=$_POST['TxtBono'];

$sql ="SELECT Num_Bono FROM t_bonos WHERE Tienda_Id_Tienda='".$MyIdTienda."' and Id_bono='".$TxtBono."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Num_Bono=$row['Num_Bono'];  
 }
}



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
    $ConceptoVenta=utf8_decode("PAGO BONO N.".$Num_Bono);
    $EstadoIngreso=2;



 $sql=("INSERT INTO t_ingresos(Cod_Recibo_Caja, Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso,Estado_Ingreso) VALUES ('".$ReciboCajaAnticipo."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".$TxtTipoPago."','".utf8_decode($TxtVoucherPago)."','".utf8_decode($Monto)."','".utf8_decode($ClienteSel)."','".utf8_decode($VentaTienda)."','".utf8_decode($ConceptoVenta)."','".$EstadoIngreso."');");
 echo($sql);
$result = $conexion->query($sql);


    }

    // Actualización del Consecutivo de Pedidos
$sql=("UPDATE t_config_tienda SET Consecutivo_ReciboCaja='".$ReciboCajaAnticipo."' WHERE Tienda_Id_Tienda='".$VentaTienda."'");
echo($sql);
$result = $conexion->query($sql);


// Actualización Del Bono
$sql=("UPDATE t_bonos SET Cliente_Id_Cliente='".$ClienteSel."', Valor_Comercial='".$SumaPagos."', Usuario_Vende='".$IdUser."', Estado_Bono='Vendido', Fecha_venta='".$TiempoActual."',recibo_caja='".$ReciboCajaAnticipo."' WHERE Id_bono='".$TxtBono."'");
echo($sql);
$result = $conexion->query($sql);


$sql=("DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."';");
echo($sql);
$result = $conexion->query($sql);


//echo("<script type='text/javascript' language='Javascript'>window.open('https://modasof.com/espejo/Administrator/index-ventas.php');</script>");

echo("<script type='text/javascript' language='Javascript'>window.open('https://modasof.com/espejo/Administrator/Pdf_ReciboCajaInmediato.php?AbonoCliente=".$ReciboCajaAnticipo."&latienda=".$VentaTienda."');</script>");

header("location:index-ventas.php");

}




 ?>

