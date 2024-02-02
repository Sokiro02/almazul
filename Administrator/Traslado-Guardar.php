<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
// Variables de  OrdenCliente.php 

$TxtConsecutivoPedido=$_POST['TxtConsecutivo'];
$TxtConsecutivoReciboCaja=$_POST['TxtConsecutivoReciboCaja'];
$TxtConsecutivoTraslado=$_POST['TxtConsecutivoTraslado'];
$TxtTienda=$_POST['TxtTienda'];
$TxtCliente=$_POST['TxtClientes'];
$TxtFechaEntrega=$_POST['TxtFechaEntrega'];
$TxtSumaPedido=$_POST['TxtSumaPedido'];
$SumaAbono=$_POST['SumaAbono'];
$EstadoIngreso=1; // Confirmado
$EstadoTekMaster=11;
$EstadoIngreso=1; // Confirmado


if ($TxtSumaPedido==0) {
	header("location:OrdenTrasladoCliente.php?Mensaje=551");
}
else
{

// Registro Pedido 

$sql=("INSERT INTO t_pedido(Cod_Pedido,Pedido_Traslado_Numero, Cliente_Id_Cliente, Fecha_Pedido, Total_Pedido, Estado_Pedido, Saldo_Abonado, Pedido_Id_Usuario, Fecha_Entrega,Tienda_Id_Tienda) VALUES ('".utf8_decode($TxtConsecutivoPedido)."','".utf8_decode($TxtConsecutivoTraslado)."','".utf8_decode($TxtCliente)."','".utf8_decode($TiempoActual)."','".utf8_decode($TxtSumaPedido)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($SumaAbono)."','".utf8_decode($IdUser)."','".utf8_decode($TxtFechaEntrega)."','".utf8_decode($TxtTienda)."')");
echo($sql);
$result = $conexion->query($sql);

		
foreach($_POST['TxtIdPago'] as $index => $nf) {
    $Codigo=$nf;
    $Monto=($_POST['TxtValorPago'][$index]);
    $TipoPago=($_POST['TxtTiporPago'][$index]);
    $TxtVoucherPago=($_POST['TxtVoucherPago'][$index]);
    $ConceptoVenta=utf8_decode("ANTICIPO A PEDIDO  PDC".$TxtConsecutivoPedido."");
    
 $sql=("INSERT INTO t_ingresos(Cod_Recibo_Caja, Pedido_Id_Pedido,Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso,Estado_Ingreso) VALUES ('".$TxtConsecutivoReciboCaja."','".$TxtConsecutivoPedido."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($TipoPago)."','".utf8_decode($TxtVoucherPago)."','".utf8_decode($Monto)."','".utf8_decode($TxtCliente)."','".utf8_decode($TxtTienda)."','".utf8_decode($ConceptoVenta)."','".$EstadoIngreso."');");

echo($sql);
$result = $conexion->query($sql);

		}
// Actualización del Consecutivo de Pedidos
$sql=("UPDATE t_config SET Cons_PedidosCl='".$TxtConsecutivoPedido."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
echo($sql);
$result = $conexion->query($sql);



// Actualización del Consecutivo Recibos de Caja
$sql=("UPDATE t_config SET Cons_RecibosCaja='".$TxtConsecutivoReciboCaja."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
echo($sql);
$result = $conexion->query($sql);

// Actualización de las solicitudes de producción

$UsuarioCero=0; // Se cambia a cero Solicitud_Id_Usuario para uqe no aparezca como una orden pendiente en alertas.
$EstadoInicial=11; // Lista de Espera


$sql=("UPDATE t_temporal_traslados SET Vendedor_Id_Usuario='".$IdUser."', Cliente_Id_Cliente='".$TxtCliente."',Pedido_Id_Pedido='".$TxtConsecutivoPedido."',Traslado_Numero='".$TxtConsecutivoTraslado."',Fecha_Entrega='".$TxtFechaEntrega."',Estado_Solicitud_Cliente='".$EstadoInicial."' WHERE Solicitud_Id_Usuari='".$IdUser."'");
echo($sql);
$result = $conexion->query($sql);

$sql=("UPDATE t_temporal_traslados SET Solicitud_Id_Usuari='".$UsuarioCero."' WHERE Solicitud_Id_Usuari='".$IdUser."'");
echo($sql);
$result = $conexion->query($sql);

// Actualización del Consecutivo Recibos de Caja
$sql=("UPDATE t_config SET Cons_Traslado='".$TxtConsecutivoTraslado."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
echo($sql);
$result = $conexion->query($sql);

$sql=("DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Traslado';");
echo($sql);
$result = $conexion->query($sql);


header("location:Pdf_ReciboCajaTraslado.php?ReciboCajaImp=".$TxtConsecutivoReciboCaja."&PedidoImp=".$TxtConsecutivoPedido."");
}

 ?>