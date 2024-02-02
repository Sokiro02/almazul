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

$ScNum=$_POST['ScNum'];
$FactNum=$_POST['FactNum'];
$ValorTotal=$_POST['ValorTotal'];
$ValorSubtotal=$_POST['ValorSubtotal'];
$ValorIva=$_POST['ValorIva'];
$VentaTienda=$_POST['VentaTienda'];
$ClienteSel=$_POST['TxtClientes'];
$TxtTipoVenta=$_POST['TxtTipoVenta'];
$SumaPagos=$_POST['TxtSumaPagos'];



$sql ="SELECT Consecutivo_Factura FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_Factura=$row['Consecutivo_Factura']+1;
    }
  }


$sql ="SELECT consecutivo_sc FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $consecutivo_sc=$row['consecutivo_sc']+1;
    }
  }



if ($consecutivo_sc != $ScNum) {
  header("location:CrearVenta.php?Mensaje=551");// Error en el consecutivo de la factura
}
else if ($ScNum=="" || $VentaTienda=="" || $ClienteSel=="") {
  header("location:CrearVenta.php?Mensaje=552"); // Algún campo está vacío
}
elseif ($TxtTipoVenta==1 & $SumaPagos==0) {
  header("location:CrearVenta.php?Mensaje=553"); // Selecciono contado y no tiene abono
}
else
{
// Se crea primreo la factura de Venta
$EstadoFactura=1; // Confirmada
$EstadoSalidaContable=1; // Confirmada

if ($MyIdTienda==2) {
  $ValorIva=0;
  $ValorSubtotal=0;
  $EstadoSalidaContable=0; 
}
$sql=("INSERT INTO t_facturas (Fecha_Factura, Num_Factura, Cliente_Id_Cliente, Subtotal_Factura, Iva_Factura, Total_Factura, Estado_Factura,Factura_Paga, Marca_Temporal, Usuario_Vendedor, Tienda_Id_Tienda,estado_sc,num_consecutivo_sc) VALUES ('".utf8_decode($TiempoActual)."','".utf8_decode($Consecutivo_Factura)."','".utf8_decode($ClienteSel)."','".utf8_decode($ValorSubtotal)."','".utf8_decode($ValorIva)."','".utf8_decode($ValorTotal)."','".utf8_decode($EstadoFactura)."','".utf8_decode($TxtTipoVenta)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($VentaTienda)."','".$EstadoSalidaContable."','".$consecutivo_sc."')");
//echo($sql);
$result = $conexion->query($sql);

 $sql=("UPDATE t_config_tienda SET Consecutivo_Factura='".$Consecutivo_Factura."' WHERE Tienda_Id_Tienda='".$MyIdTienda."';");
//echo($sql);
$result = $conexion->query($sql);

// Actualización de Consecutivo salida contable
$sql=("UPDATE t_config_tienda SET consecutivo_sc='".$consecutivo_sc."' WHERE Tienda_Id_Tienda='".$MyIdTienda."';");
//echo($sql);
$result = $conexion->query($sql);


$VentaConfirmada=2;
$Bodega="Bodega";
$SalidaVenta=utf8_decode("Salida Venta");
// Cambiar Estado al detalle de la venta
foreach ($_POST['TxtCadIdVenta'] as $IdVenta => $Iv) {
  $VentaId=$Iv;
  $TxtRefVenta=($_POST['TxtRefVenta'][$IdVenta]);
  $TxtTallaVenta=($_POST['TxtTallaVenta'][$IdVenta]);
  $TxtRefCompletaVenta=($_POST['TxtRefCompletaVenta'][$IdVenta]);
  $TxtCantVenta=($_POST['TxtCantVenta'][$IdVenta]);

  $sql=("UPDATE t_ventas SET Estado_Venta='".$VentaConfirmada."',Cliente_Id_Cliente='".$ClienteSel."',Factura_Id_Factura='".$Consecutivo_Factura."' WHERE Id_Venta='".$VentaId."';");
  //echo($sql);
$result = $conexion->query($sql);

  $sql=("UPDATE t_ventas SET Estado_Venta='".$VentaConfirmada."',Cliente_Id_Cliente='".$ClienteSel."',consecutivosc_id_consecutivosc='".$consecutivo_sc."' WHERE Id_Venta='".$VentaId."';");
//echo($sql);
$result = $conexion->query($sql);

}

// Descarga de Inventario 
foreach ($_POST['TxtCadIdVenta'] as $IdVenta2 => $Iv2) {
    $VentaId2=$Iv2;
    $TxtRefVenta2=($_POST['TxtRefVenta'][$IdVenta2]);
    $TxtTallaVenta2=($_POST['TxtTallaVenta'][$IdVenta2]);
    $TxtRefCompletaVenta2=($_POST['TxtRefCompletaVenta'][$IdVenta2]);
    $TxtCantVenta2=($_POST['TxtCantVenta'][$IdVenta2]);

    $sql=("INSERT INTO t_inventario_ref(Tienda_Id_Tienda, Inv_Ref, Talla_Id_Talla, Ref_Completa, Cantidad_Inv, Fecha_Salida, Ubicacion, Tipo_Mov_Inv, N_Factura, Responsable_Id_Usuario, Fecha_Registro_Modasof) VALUES ('".utf8_decode($VentaTienda)."','".utf8_decode($TxtRefVenta2)."','".utf8_decode($TxtTallaVenta2)."','".utf8_decode($TxtRefCompletaVenta2)."','".utf8_decode($TxtCantVenta2)."','".utf8_decode($TiempoActual)."','".utf8_decode($Bodega)."','".utf8_decode($SalidaVenta)."','".utf8_decode($Consecutivo_Factura)."','".$IdUser."','".$TiempoActual."');");
//echo($sql);
    $result = $conexion->query($sql);
    
    $idtienda=$VentaTienda;
    $cod_ref_completo=$TxtRefCompletaVenta2;
    $cod_referencia=$TxtRefVenta2;
    $cantidad=$TxtCantVenta2;
    $Cantidadcero=0;
    //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL           
    $sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'" ;
    $resultados = $conexion->query($sql1) or die (mysqli_error($conexion));

    if ($resultados->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
    }else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
        
        $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,id_talla) VALUES ('','".$idtienda."','".$cod_referencia."','".$cod_ref_completo."','".$Cantidadcero."','".$TxtTallaVenta2."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
        $ResultInsertar = $conexion->query($SqlAgregar);

        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
    }
}


// Ciclo de Registro de Ingresos 

foreach($_POST['TxtIdPago'] as $index => $nf) {
    $Codigo=$nf;
    $Monto=($_POST['TxtValorPago'][$index]);
    $TipoPago=($_POST['TxtTiporPago'][$index]);
    $TxtVoucherPago=($_POST['TxtVoucherPago'][$index]);
    $ConceptoVenta=utf8_decode("PAGO DE NOTA ENTREGA N.".$Consecutivo_Factura."");
    
    $sql=("INSERT INTO t_ingresos(consecutivosc_id_consecutivosc,Factura_Cod_Factura, Fecha_Ingreso, Ingreso_Id_Usuario, Medio_Pago, Num_Transaccion, Valor_Ingreso, Cliente_Id_Cliente, Tienda_Id_Tienda, Concepto_Ingreso) VALUES ('".utf8_decode($consecutivo_sc)."','".utf8_decode($Consecutivo_Factura)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($TipoPago)."','".utf8_decode($TxtVoucherPago)."','".utf8_decode($Monto)."','".utf8_decode($ClienteSel)."','".utf8_decode($VentaTienda)."','".utf8_decode($ConceptoVenta)."');");

//echo($sql);
$result = $conexion->query($sql);

}

$sql=("DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."';");
echo($sql);
$result = $conexion->query($sql);


//header("location:CrearVenta.php?Mensaje=333&Factura=".$FactNum."");
if ($MyIdTienda==2) {
  header("location:Pdf_Factura.php?FacturaImp=".$Consecutivo_Factura."&DeTienda=".$MyIdTienda."");
}
else
{
  header("location:Pdf_FacturaNE.php?FacturaImp=".$consecutivo_sc."&DeTienda=".$MyIdTienda."");
}

}
 ?>

