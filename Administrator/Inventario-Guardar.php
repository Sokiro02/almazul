<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


// Recibir Variables
$TxtTalla=$_POST['TxtTalla'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtAlmacen=$_POST['TxtAlmacen'];
$TxtRef=$_POST['TxtRef'];
$TxtUbica=$_POST['TxtUbica'];

// Consulta Nombre Talla
$sql ="SELECT Nom_Talla from t_tallas WHERE Id_Talla='".$TxtTalla."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nom_Talla=$row['Nom_Talla'];
 }
}
// Fin de la consulta 

$RefCompleta=$TxtRef."-".$Nom_Talla;

// Ingreso a Inventario 

   $TipoMov="Ingreso Inicial";

$sql="INSERT INTO t_inventario_ref(Tienda_Id_Tienda, Inv_Ref, Talla_Id_Talla, Ref_Completa, Cantidad_Inv, Fecha_Ingreso, 
Ubicacion, Tipo_Mov_Inv,Responsable_Id_Usuario,Fecha_Registro_Modasof) VALUES 
('".$TxtAlmacen."','".$TxtRef."','".$TxtTalla."','".$RefCompleta."','".$TxtCantidad."','".$TiempoActual."',
'".$TxtUbica."','".$TipoMov."','".$IdUser."','".$TiempoActual."');";

	$result=$conexion->query($sql);


$sql1 ="SELECT Id_Tienda,Referencia_Completa FROM t_inventario WHERE Id_Tienda='".$TxtAlmacen."' and Referencia_Completa='".$RefCompleta."'" ;
$resultados = $conexion->query($sql1) or die (mysqli_error($conexion));
if ($resultados->num_rows>0){ //SI LA REFERENCIA YA ESTA CARGADA EN EL INVENTARIO.
    $SqlActualizar ="UPDATE t_inventario SET Cantidad=Cantidad+'".$TxtCantidad."' WHERE Id_Tienda='".$TxtAlmacen."' and Referencia_Completa='".$RefCompleta."'"; //ACTUALIZAMOS EL INVENTARIO
    $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
}else{ //SI LA REFERENCIA NO ESTA CARGADA EN EL INVENTARIO
    $SqlAgregar ="INSERT INTO t_inventario(Id,Id_Tienda,Referencia,Referencia_Completa,Cantidad,Id_Talla) VALUES ('','".$TxtAlmacen."','".$TxtRef."','".$RefCompleta."','".$TxtCantidad."','".$TxtTalla."')"; //AGREGAMOS LA NUEVA REFERENCIA AL INVENTARIO
    $ResultInsertar = $conexion->query($SqlAgregar);
} 

 //Echo($sql);
include("Lib/seguridad.php");
$Datos="Agrego al inventario de la tienda ".$TxtAlmacen." la referencia ".$RefCompleta." Talla ".$TxtTalla." La cantidad ".$TxtCantidad;
$Paginas= $_SERVER['PHP_SELF'];
$seguridad = AgregarLog($IdUser,$Datos,$Paginas);


header("location:Cargar-Inventario.php?Mensaje=1&RefSel=".$TxtRef."");



//*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************

 ?>
