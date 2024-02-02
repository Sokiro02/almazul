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

// Variables de  cc_crearsalida.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$FactNum=$_POST['FactNum'];
$ValorTotal=$_POST['ValorTotal'];
$ValorSubtotal=$_POST['ValorSubtotal'];
$ValorIva=$_POST['ValorIva'];
$VentaTienda=$_POST['VentaTienda'];
$ClienteSel=$_POST['TxtClientes'];
$ProveedorSel=$_POST['TxtProveedor'];
$TxtTipoVenta=$_POST['TxtTipoVenta'];
$SumaPagos=$_POST['TxtSumaPagos'];
$Txtobservaciones=$_POST['Txtobservaciones'];


$sql ="SELECT Cons_cc FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Cons_cc=$row['Cons_cc']+1;
    }
  }

if ($Cons_cc != $FactNum) {
  header("location:cc_crearsalida.php?Mensaje=551");// Error en el consecutivo de la factura
}
else if ($FactNum=="" || $VentaTienda=="" || $ProveedorSel=="") {
  header("location:cc_crearsalida.php?Mensaje=552"); // Algún campo está vacío
}
elseif ($TxtTipoVenta==1 & $SumaPagos==0) {
  header("location:cc_crearsalida.php?Mensaje=553"); // Selecciono contado y no tiene abono
}
else
{
// Se crea primreo la factura de Venta
$EstadoRemision=1; // Confirmada


$sql=("INSERT INTO t_cc (Fecha_Remision, Num_Remision, Cliente_Id_Cliente, Subtotal_Remision, Iva_Remision, Total_Remision, Estado_Remision, Marca_Temporal, Usuario_Vendedor, Tienda_Id_Tienda, Observa_Remision,proveedor_id_proveedor) VALUES 
  ('".utf8_decode($TiempoActual)."',
  '".utf8_decode($Cons_cc)."','".utf8_decode($ClienteSel)."','".utf8_decode($ValorSubtotal)."','".utf8_decode($ValorIva)."','".utf8_decode($ValorTotal)."','".utf8_decode($EstadoRemision)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($VentaTienda)."','".$Txtobservaciones."','".$ProveedorSel."')");

//echo($sql);
$result = $conexion->query($sql);

$empresa="TEKSYSTEM S.A.S";

$sql=("UPDATE t_config SET Cons_cc='".$FactNum."' WHERE Desarrollador='".$empresa."';");
//echo($sql);
$result = $conexion->query($sql);


$VentaConfirmada=2;
$Bodega="Bodega";
$SalidaVenta=utf8_decode("Salida Cuenta Cobro");
// Cambiar Estado al detalle de la venta
foreach ($_POST['TxtCadIdVenta'] as $IdVenta => $Iv) {
  $VentaId=$Iv;
  $TxtRefVenta=($_POST['TxtRefVenta'][$IdVenta]);
  $TxtTallaVenta=($_POST['TxtTallaVenta'][$IdVenta]);
  $TxtRefCompletaVenta=($_POST['TxtRefCompletaVenta'][$IdVenta]);
  $TxtCantVenta=($_POST['TxtCantVenta'][$IdVenta]);

  $sql=("UPDATE t_salidas_cc SET Estado_Venta='".$VentaConfirmada."',Cliente_Id_Cliente='".$ClienteSel."',Factura_Id_Factura='".$FactNum."',proveedor_id_proveedor='".$ProveedorSel."' WHERE Id_Venta='".$VentaId."';");
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


   $sql=("INSERT INTO t_inventario_ref(Tienda_Id_Tienda, Inv_Ref, Talla_Id_Talla, Ref_Completa, Cantidad_Inv, Fecha_Salida, Ubicacion, Tipo_Mov_Inv, N_Remision, Responsable_Id_Usuario, Fecha_Registro_Modasof) VALUES ('".utf8_decode($VentaTienda)."','".utf8_decode($TxtRefVenta2)."','".utf8_decode($TxtTallaVenta2)."','".utf8_decode($TxtRefCompletaVenta2)."','".utf8_decode($TxtCantVenta2)."','".utf8_decode($TiempoActual)."','".utf8_decode($Bodega)."','".utf8_decode($SalidaVenta)."','".utf8_decode($FactNum)."','".$IdUser."','".$TiempoActual."');");
//echo($sql);
$result = $conexion->query($sql);

    $idtienda=$VentaTienda;
    $cod_ref_completo=$TxtRefCompletaVenta2;
    $cod_referencia=$TxtRefVenta2;
    $cantidad=$TxtCantVenta2;

    //AGREGAR O ACTUALIZAR DATOS DE LA TABLA DEL INVENTARIO REAL           
    $sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'" ;
    $resultados = $conexion->query($sql1) or die (mysqli_error($conexion));

    if ($resultados->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.

        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
    }else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
        
        $SqlAgregar ="INSERT INTO t_inventario (Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,id_talla) VALUES ('','".$idtienda."','".$cod_referencia."','".$cod_ref_completo."','".$cantidad."','".$TxtTallaVenta2."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
        $ResultInsertar = $conexion->query($SqlAgregar);

        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
    }


}


// Ciclo de Registro de Ingresos 

//header("location:Pdf_Remision.php?FacturaImp=".$FactNum."&mitienda=".$idtienda."&cliente=".$ClienteSel."");

echo("<script type='text/javascript' language='Javascript'>window.open('https://modasof.com/espejo/Administrator/cc_crearsalida.php');</script>");

echo("<script type='text/javascript' language='Javascript'>window.open('Pdf_Remision.php?FacturaImp=".$FactNum."&mitienda=".$idtienda."&cliente=".$ClienteSel."&proveedor=".$ProveedorSel."');</script>");



header("location:cc_crearsalida.php?Mensaje=333&Factura=".$FactNum."");

}

 ?>

