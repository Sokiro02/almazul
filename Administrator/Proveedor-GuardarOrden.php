<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
include("Lib/seguridad.php");

// Recoger Variables de Proveedor-CrearOrden.php


$TxtOrden=$_POST['TxtOrden'];
$TxtFechaSolicitud=$_POST['TxtFechaSolicitud'];
$TxtFechaEstimada=$_POST['TxtFechaEstimada'];
$TxtBodega=$_POST['TxtBodega'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtInsumoSel=$_POST['TxtInsumoSel'];
$TxtCostoInsumo=$_POST['TxtCostoInsumo'];
$TxtTotal=$_POST['TxtTotal'];
$TxtLote=$_POST['TxtLote'];
$TxtTipoPago=$_POST['TxtTipoPago'];


// Campos Ocultos

$TxtCodOrden=$_POST['TxtCodOrden'];
$TxtIdProveedor=$_POST['TxtIdProveedor'];

date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');

$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($TxtCostoInsumo);
$TxtValorSubtotal=$TxtCantidad*$For_Costo1;

// //*****************************************************************************************************
// // Campos Formulados 
// //*****************************************************************************************************
// $TipoEstancia="Hospedaje";
// $EstadoEstancia="Abierta";
// $TipoProducto=16;
// $TarifaSinIva=round(($Qr_Valor_Tarifa/1.19),1);
// $ValorDescuento=($TarifaSinIva*$Noches)*($TxtDescuento/100);
// $SubTotal=round((($TarifaSinIva*$Noches)-$ValorDescuento),1);
// $ValorIva=round((($SubTotal*$Qr_IVA)/100),1);
// $SumaTotal=$SubTotal+$ValorIva;

//*****************************************************************************************************
// Validación Código Reserva
//*****************************************************************************************************
if ($TxtOrden=="") {

//*****************************************************************************************************
// Consulta Consecutivo
//*****************************************************************************************************
$sql ="SELECT Consecutivo FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
          $Qr_Consecutivo=$row['Consecutivo'];
 }
}

//*****************************************************************************************************
// Suma a Consecutivo y guardao en Base
//*****************************************************************************************************
$NuevaOrden=$Qr_Consecutivo+1;
$EstadoInsumo=1;

$sql=("INSERT INTO t_orden_compra_insumos(Forma_Pago,Cod_Orden_Prov, Cod_Orden_Modasof, Proveedor_Id_Proveedor, Fecha_Solicitud, Marca_Temporal, Usuario_Responsable,Bodega_Id_Bodega, Insumo_Cod_Insumo, Lote_Insumo, Cantidad_Solicitada, Costo_Insumo,Valor_Subtotal, Fecha_Est_Llegada, Estado_Insumo)
 VALUES ('".utf8_decode($TxtTipoPago)."','".utf8_decode($NuevaOrden)."','".utf8_decode($NuevaOrden)."','".utf8_decode($TxtIdProveedor)."','".utf8_decode($TxtFechaSolicitud)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($IdUser)."','".utf8_decode($TxtBodega)."','".utf8_decode($TxtInsumoSel)."','".utf8_decode($TxtLote)."','".utf8_decode($TxtCantidad)."','".utf8_decode($For_Costo1)."','".utf8_decode($TxtValorSubtotal)."','".utf8_decode($TxtFechaEstimada)."','".$EstadoInsumo."')");
//echo($sql);
$result = $conexion->query($sql);
if ($result){
    $Datos = "Orden de compra, se agrego el insumo: ".$TxtInsumoSel." al proveedor ".$TxtIdProveedor. "Con Cod_Orden_Prov = ".$NuevaOrden;
    $seguridad = AgregarLog($IdUser,$Datos,"Proveedor-GuardarOrden.php");
}

$sql ="UPDATE t_config SET Consecutivo='".$NuevaOrden."' WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);


header("location:Proveedor-CrearOrden.php?DocSel=".$TxtIdProveedor."&CodEst=".$NuevoCodOrden."&Mensaje=1&NumeroOrden=".$NuevaOrden."&F1=".$TxtFechaSolicitud."&F2=".$TxtFechaEstimada."&Bod=".$TxtBodega."&PagId=".$TxtTipoPago."");

}
//*****************************************************************************************************
// guardao en Base sin sumar consecutivo
//*****************************************************************************************************
else
{
	$EstadoInsumo=1;
	
		$sql=("INSERT INTO t_orden_compra_insumos(Forma_Pago,Cod_Orden_Prov, Cod_Orden_Modasof, Proveedor_Id_Proveedor, Fecha_Solicitud, Marca_Temporal, Usuario_Responsable,Bodega_Id_Bodega, Insumo_Cod_Insumo, Lote_Insumo, Cantidad_Solicitada, Costo_Insumo,Valor_Subtotal, Fecha_Est_Llegada, Estado_Insumo) VALUES ('".utf8_decode($TxtTipoPago)."','".utf8_decode($TxtOrden)."','".utf8_decode($TxtCodOrden)."','".utf8_decode($TxtIdProveedor)."','".utf8_decode($TxtFechaSolicitud)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($IdUser)."','".utf8_decode($TxtBodega)."','".utf8_decode($TxtInsumoSel)."','".utf8_decode($TxtLote)."','".utf8_decode($TxtCantidad)."','".utf8_decode($For_Costo1)."','".utf8_decode($TxtValorSubtotal)."','".utf8_decode($TxtFechaEstimada)."','".$EstadoInsumo."')");
//echo($sql);
$result = $conexion->query($sql);

header("location:Proveedor-CrearOrden.php?DocSel=".$TxtIdProveedor."&CodEst=".$TxtCodOrden."&Mensaje=1&NumeroOrden=".$TxtOrden."&F1=".$TxtFechaSolicitud."&F2=".$TxtFechaEstimada."&Bod=".$TxtBodega."&PagId=".$TxtTipoPago."");

}



//header("location:index.php");
 ?>