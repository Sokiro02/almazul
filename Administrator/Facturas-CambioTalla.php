<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];


$TxtTallaSolicitada=$_POST['TxtTallaSolicitada'];
$TxtIdVenta=$_POST['TxtIdVenta'];
$TxtFactura=$_POST['TxtFactura'];
$TxtReferencia=$_POST['TxtReferencia'];
$TxtRefVendida=$_POST['TxtRefVendida'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtNuevaTalla=$_POST['TxtNuevaTalla'];
$TxtTienda=$_POST['TxtTienda'];


$sql ="SELECT Nom_Talla FROM t_tallas WHERE Id_Talla='".$TxtNuevaTalla."'";
	//Echo($sql);
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Nom_Talla=$row['Nom_Talla'];                  
 }
}



$RefSalida=$TxtReferencia."-".$Nom_Talla;


// Actualizar Inventario Suma la devolución
 $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad+'".$TxtCantidad."' WHERE Id_Tienda='".$TxtTienda."' and Referencia_Completa='".$TxtRefVendida."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));

        // Actualizar Inventario Resta la que Sale
 $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad-'".$TxtCantidad."' WHERE Id_Tienda='".$TxtTienda."' and Referencia_Completa='".$RefSalida."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));


$SqlActualizar ="UPDATE t_ventas SET Ref_Vendida='".$RefSalida."',Talla_Solicitada='".$TxtNuevaTalla."' WHERE Id_Venta='".$TxtIdVenta."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));


header("location:Clientes-Devoluciones.php?Mensaje=333&NumeroFactura=".$TxtFactura."");


 ?>