<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$TxtTallaSolicitada=$_POST['TxtTallaSolicitada'];
$TxtIdVenta=$_POST['TxtIdVenta'];
$TxtFactura=$_POST['TxtFactura'];
$TxtSalidacontable=$_POST['TxtSalidacontable'];
$TxtReferencia=$_POST['TxtReferencia'];
$TxtRefVendida=$_POST['TxtRefVendida'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtNuevaTalla=$_POST['TxtNuevaTalla'];
$TxtTienda=$_POST['TxtTienda'];
$TxtValor=$_POST['TxtValor'];
$TxtCliente=$_POST['TxtCliente'];
$TxtIdNotacredito=$_POST['TxtIdNotacredito'];


$ValorNotaCr=$TxtCantidad*$TxtValor;

$sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$TxtTienda."' and Referencia_Completa='".$TxtRefVendida."'" ;
    $resultados = $conexion->query($sql1) or die (mysqli_error($conexion));

    if ($resultados->num_rows>0){
// Actualizar Inventario Suma la devolución
 $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$TxtCantidad."' WHERE Id_Tienda='".$TxtTienda."' and Referencia_Completa='".$TxtRefVendida."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
}
else
{
        $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,id_talla) VALUES ('','".$TxtTienda."','".$TxtReferencia."','".$TxtRefVendida."','".$TxtCantidad."','".$TxtTallaSolicitada."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
        $ResultInsertar = $conexion->query($SqlAgregar);

        $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$TxtCantidad."' WHERE Id_Tienda='".$TxtTienda."' and Referencia_Completa='".$TxtRefVendida."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
}
       
$EstadoTek=0;

$SqlActualizar ="UPDATE t_ventas SET Estado_Devolucion='".$EstadoTek."' WHERE Id_Venta='".$TxtIdVenta."'"; //ACTUALIZAMOS EL ESTADO DE LA VENTA
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));



$sql=("DELETE FROM t_devoluciones WHERE id='".$TxtIdNotacredito."'");
//echo($sql);
$result = $conexion->query($sql);



header("location:Clientes-Devoluciones.php?Mensaje=332&NumeroFactura=".$TxtSalidacontable."");


 ?>