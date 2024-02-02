<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


$TxtBodega=$_POST['TxtBodega'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtCantidadEspera=$_POST['TxtCantidadEspera'];
$TxtTalla=$_POST['TxtTalla'];
$TxtAlmacen=$_POST['TxtAlmacen'];
$TxtRef=$_POST['TxtRef'];
$TxtDetalleOriginal=$_POST['TxtDetalle'];
$TxtDetalle=str_replace("'", "", $TxtDetalleOriginal);

$TxtPrecio=$_POST['TxtPrecio'];
$EstadoSolicitud=1;
$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);

if ($TxtPrecio<$For_Costo1) {
	header("location:Produccion-SolicitudCliente.php?RefSel=".$TxtRef."&Mensaje=11");
}
else
{

if ($TxtCantidad=="") {
	$CantidadSolicitada=$TxtCantidadEspera;
	$DisponibilidadInsumo=utf8_decode("Insumo en Espera");
}
else
{
	$CantidadSolicitada=$TxtCantidad;
	$DisponibilidadInsumo=utf8_decode("Insumo Disponible");	
}

// Consulta Nombre Talla
$sql ="SELECT Nom_Talla from t_tallas WHERE Id_Talla='".$TxtTalla."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nom_Talla=$row['Nom_Talla'];
 }
}
// Fin de la consulta 

	// Guardar Solicitud 
$sql=("INSERT INTO t_temporal_sol(Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia, Fecha_Solicitud,Fecha_Observacion,Observa_Id_Usuario, Solicitud_Id_Usuari, Valor_Prenda,Valor_Final, Observa_Cliente,Dispon_Insumo) VALUES ('".$TxtBodega."','".$CantidadSolicitada."','".$TxtTalla."','".$TxtAlmacen."','".$TxtRef."','".$TiempoActual."','".$TiempoActual."','".$IdUser."','".$IdUser."','".$TxtPrecio."','".$For_Costo1."','".$TxtDetalle."','".$DisponibilidadInsumo."')");
//Echo($sql);
$result=$conexion->query($sql);

header("location:OrdenCliente.php");

}
 ?>
