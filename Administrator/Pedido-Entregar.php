<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
// Variables de  OrdenCliente.php 

$TxtScNum=$_POST['TxtScNum'];
$TxtConsecutivoFactura=$_POST['TxtConsecutivo'];
$TxtConsecutivoPedido=$_POST['TxtConsecutivoPedido'];
$TxtConsecutivoCaja=$_POST['TxtConsecutivoCaja'];
$TxtTienda=$_POST['TxtTienda'];
$TxtCliente=$_POST['TxtClienteSel'];
$TxtSumaPedido=$_POST['TxtSumaPedido'];
$TxtTotalsinIva=$_POST['TxtTotalsinIva'];
$TxtTotalIva=$_POST['TxtTotalIva'];
$SumaPagos=$_POST['SumaAbono'];
$SumaAnticipos=$_POST['SumaAnticipos'];
$TxtTipoVenta=$_POST['TxtTipoVenta'];



$EstadoIngreso=1; // Confirmado
$EstadoTekMaster=1;
$EstadoIngreso=1; // Confirmado

if ($TxtSumaPedido==0) {
	header("location:CrearCliente.php?ClientePedido=".$TxtCliente."&Mensaje=22");
}
else
{

// Actualización del Pedido Entregado
$PedidoEntregado=10; // Lista de Espera
$sql=("UPDATE t_pedido SET Estado_Pedido='".$PedidoEntregado."',Fecha_EntregaCliente='".$TiempoActual."',Factura_Num_Factura='".$TxtConsecutivoFactura."',consecutivosc_id_consecutivosc='".$TxtScNum."' WHERE Cod_Pedido='".$TxtConsecutivoPedido."'");
echo($sql);
$result = $conexion->query($sql);



// Registro pago pendiente.		
foreach($_POST['TxtIdPago'] as $index => $nf) {

    $Codigo=$nf;
    $Monto=($_POST['TxtValorPago'][$index]);
    $TipoPago=($_POST['TxtTiporPago'][$index]);
    $TxtVoucherPago=($_POST['TxtVoucherPago'][$index]);
    $ConceptoVenta=utf8_decode("CANCELA PEDIDO  PDC".$TxtConsecutivoPedido."");
    
 $sql=("INSERT INTO t_ingresos(Pedido_Id_Pedido,Factura_Cod_Factura,consecutivosc_id_consecutivosc,Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso,Estado_Ingreso) VALUES ('".$TxtConsecutivoPedido."','".$TxtConsecutivoFactura."','".$TxtScNum."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($TipoPago)."','".utf8_decode($TxtVoucherPago)."','".utf8_decode($Monto)."','".utf8_decode($TxtCliente)."','".utf8_decode($TxtTienda)."','".utf8_decode($ConceptoVenta)."','".$EstadoIngreso."');");

echo($sql);
$result = $conexion->query($sql);

		}



// Actualizar el consecutivo de Recibos de Caja
//$sql=("UPDATE t_config_tienda SET Consecutivo_ReciboCaja='".$TxtConsecutivoCaja."' WHERE Tienda_Id_Tienda='".$TxtTienda."';");
//echo($sql);
//$result = $conexion->query($sql);

// Guardar Factura

$EstadoFactura=1; // Confirmada
$EstadoSalidaContable=1; // Confirmada
//$TxtTipoVenta=1; // Contado

$sql=("INSERT INTO t_facturas (Fecha_Factura, Num_Factura, Cliente_Id_Cliente, Subtotal_Factura, Iva_Factura, Total_Factura, Estado_Factura,Factura_Paga, Marca_Temporal, Usuario_Vendedor, Tienda_Id_Tienda,estado_sc,num_consecutivo_sc) VALUES ('".utf8_decode($TiempoActual)."','".utf8_decode($TxtConsecutivoFactura)."','".utf8_decode($TxtCliente)."','".utf8_decode($TxtTotalsinIva)."','".utf8_decode($TxtTotalIva)."','".utf8_decode($TxtSumaPedido)."','".utf8_decode($EstadoFactura)."','".utf8_decode($TxtTipoVenta)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($TxtTienda)."','".utf8_decode($EstadoSalidaContable)."','".utf8_decode($TxtScNum)."')");
echo($sql);
$result = $conexion->query($sql);

// Actualización del Consecutivo de Facturas
 $sql=("UPDATE t_config_tienda SET Consecutivo_Factura='".$TxtConsecutivoFactura."' WHERE Tienda_Id_Tienda='".$TxtTienda."';");
echo($sql);
$result = $conexion->query($sql);

// Actualización del Consecutivo de Facturas
 $sql=("UPDATE t_config_tienda SET consecutivo_sc='".$TxtScNum."' WHERE Tienda_Id_Tienda='".$TxtTienda."';");
echo($sql);
$result = $conexion->query($sql);



// Actualización de las solicitudes de producción
$EstadoEntrega=10; // Lista de Espera

$sql=("UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='".$EstadoEntrega."', Fecha_EntregaCliente='".$TiempoActual."', Solicitud_Facturada='1',Factura_Num_Factura='".$TxtConsecutivoFactura."',consecutivosc_id_consecutivosc='".$TxtScNum."' WHERE Pedido_Id_Pedido='".$TxtConsecutivoPedido."'");
echo($sql);
$result = $conexion->query($sql);




// Registro de Ventas

foreach ($_POST['TxtCadIdVenta'] as $IdVenta => $Iv) {
  $VentaId=$Iv;
  $TxtRefVenta=($_POST['TxtRefVenta'][$IdVenta]);
  $TxtTallaVenta=($_POST['TxtTallaVenta'][$IdVenta]);
  $TxtRefCompletaVenta=($_POST['TxtRefCompletaVenta'][$IdVenta]);
  $TxtCantVenta=($_POST['TxtCantVenta'][$IdVenta]);
  $TxtValorVenta=($_POST['TxtValorVenta'][$IdVenta]);
  $TxtValorFinal=($_POST['TxtValorFinal'][$IdVenta]);


 $sql=("INSERT INTO t_ventas( Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia, Ref_Vendida, Fecha_Solicitud, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final,Cliente_Id_Cliente, Factura_Id_Factura,consecutivosc_id_consecutivosc) VALUES ('".utf8_decode($TxtCantVenta)."','".utf8_decode($TxtTallaVenta)."','".utf8_decode($TxtTienda)."','".utf8_decode($TxtRefVenta)."','".utf8_decode($TxtRefCompletaVenta)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($TxtValorVenta)."','".utf8_decode($TxtValorFinal)."','".utf8_decode($TxtCliente)."','".utf8_decode($TxtConsecutivoFactura)."','".utf8_decode($TxtScNum)."')");
echo($sql);
$result = $conexion->query($sql);



$idtienda=$TxtTienda;
    $cod_ref_completo=$TxtRefCompletaVenta;
    $cod_referencia=$TxtRefVenta;
    $cantidad=$TxtCantVenta;
    //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL           
    $sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'" ;
    $resultados = $conexion->query($sql1) or die (mysqli_error($conexion));

    if ($resultados->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));

        
    }else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
        
        $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,id_talla) VALUES ('','".$idtienda."','".$cod_referencia."','".$cod_ref_completo."','".$cantidad."','".$TxtTallaVenta2."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
        $ResultInsertar = $conexion->query($SqlAgregar);

        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
    }

}

// Actualización de Factura a los anticipos

$sql=("UPDATE t_ingresos SET Factura_Cod_Factura='".$TxtConsecutivoFactura."', consecutivosc_id_consecutivosc='".$TxtScNum."' WHERE Pedido_Id_Pedido='".$TxtConsecutivoPedido."'");
echo($sql);
$result = $conexion->query($sql);

$sql=("DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Orden';");
echo($sql);
$result = $conexion->query($sql);


//header("location:PedidosEntregados.php?Mensaje=333&Factura=".$TxtConsecutivoFactura."");
header("location:Pdf_FacturaNE.php?FacturaImp=".$TxtScNum."&DeTienda=".$TxtTienda."");
}

 ?>