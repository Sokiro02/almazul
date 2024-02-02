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

// Variables de  CrearPlanSepare.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$FactNum=$_POST['FactNum'];
$ValorTotal=$_POST['ValorTotal'];
$ValorSubtotal=$_POST['ValorSubtotal'];
$ValorIva=$_POST['ValorIva'];
$VentaTienda=$_POST['VentaTienda'];
$ClienteSel=$_POST['TxtClientes'];
$TxtTipoVenta=$_POST['TxtTipoVenta'];
$SumaPagos=$_POST['TxtSumaPagos'];

$sql ="SELECT Consecutivo_PlanSepare FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_PlanSepare=$row['Consecutivo_PlanSepare']+1;
    }
  }

if ($Consecutivo_PlanSepare != $FactNum) {
  header("location:CrearPlanSepare.php?Mensaje=551");// Error en el consecutivo de la factura
}
else if ($FactNum=="" || $VentaTienda=="" || $ClienteSel=="") {
  header("location:CrearPlanSepare.php?Mensaje=552"); // Algún campo está vacío
}
else
{

// Se crea primreo la factura de Venta
$EstadoFactura=1; // Confirmada

$sql=("INSERT INTO t_separados (Fecha_Separe, Num_Separe, Cliente_Id_Cliente, Subtotal_Separe, Iva_Separe, Total_Separe, Estado_Separe,Separe_Paga, Marca_Temporal, Usuario_Vendedor, Tienda_Id_Tienda) VALUES ('".utf8_decode($TiempoActual)."','".utf8_decode($FactNum)."','".utf8_decode($ClienteSel)."','".utf8_decode($ValorSubtotal)."','".utf8_decode($ValorIva)."','".utf8_decode($ValorTotal)."','".utf8_decode($EstadoFactura)."','".utf8_decode($TxtTipoVenta)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($VentaTienda)."')");
//echo($sql);
$result = $conexion->query($sql);


 $sql=("UPDATE t_config_tienda SET Consecutivo_PlanSepare='".$FactNum."' WHERE Tienda_Id_Tienda='".$MyIdTienda."';");
//echo($sql);
$result = $conexion->query($sql);




$VentaConfirmada=2;
$Bodega="Bodega";
$SalidaVenta=utf8_decode("Referencia Separada");
// Cambiar Estado al detalle de la venta
foreach ($_POST['TxtCadIdVenta'] as $IdVenta => $Iv) {
  $VentaId=$Iv;
  $TxtRefVenta=($_POST['TxtRefVenta'][$IdVenta]);
  $TxtTallaVenta=($_POST['TxtTallaVenta'][$IdVenta]);
  $TxtRefCompletaVenta=($_POST['TxtRefCompletaVenta'][$IdVenta]);
  $TxtCantVenta=($_POST['TxtCantVenta'][$IdVenta]);

  $sql=("UPDATE t_plansepare SET Estado_Venta='".$VentaConfirmada."',Cliente_Id_Cliente='".$ClienteSel."',Factura_Id_Factura='".$FactNum."' WHERE Id_Venta='".$VentaId."';");
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

    $sql=("INSERT INTO t_inventario_separe(Tienda_Id_Tienda, Inv_Ref, Talla_Id_Talla, Ref_Completa, Cantidad_Inv, Fecha_Salida, Ubicacion, Tipo_Mov_Inv, N_Factura, Responsable_Id_Usuario, Fecha_Registro_Modasof) VALUES ('".utf8_decode($VentaTienda)."','".utf8_decode($TxtRefVenta2)."','".utf8_decode($TxtTallaVenta2)."','".utf8_decode($TxtRefCompletaVenta2)."','".utf8_decode($TxtCantVenta2)."','".utf8_decode($TiempoActual)."','".utf8_decode($Bodega)."','".utf8_decode($SalidaVenta)."','".utf8_decode($FactNum)."','".$IdUser."','".$TiempoActual."');");
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
        
        $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,id_talla) VALUES ('','".$idtienda."','".$cod_referencia."','".$cod_ref_completo."','".$cantidad."','".$TxtTallaVenta2."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
        $ResultInsertar = $conexion->query($SqlAgregar);

        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$cantidad."' WHERE Id_Tienda='".$idtienda."' and Referencia_Completa='".$cod_ref_completo."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
    }
}


header("location:CrearPlanSepare.php?Mensaje=333&Factura=".$FactNum."");
}
 ?>

