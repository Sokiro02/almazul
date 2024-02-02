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

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


$TxtCantidad=$_POST['TxtCantidad'];
$TxtTalla=$_POST['TxtTalla'];
$TxtTienda=$_POST['TxtTienda'];
$TxtTiendaSolicita=$_POST['TxtTiendaSolicita'];
$TxtRef=$_POST['TxtRef'];
$TxtDetalle=$_POST['TxtDetalle'];
$TxtPrecio=$_POST['TxtPrecio'];
$EstadoSolicitud=1;
$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);


if ($TxtPrecio<$For_Costo1) {
	header("location:Traslado-SolicitudCliente.php?RefSel=".$TxtRef."&Mensaje=11");
}
else
{

// Guardar Solicitud 
$sql=("INSERT INTO t_temporal_traslados( Cant_Solicitada, Talla_Solicitada, Solicita_Id_Tienda,Envia_Id_Tienda, Referencia_Id_Referencia, Fecha_Solicitud,Fecha_Observacion,Observa_Id_Usuario, Solicitud_Id_Usuari, Valor_Prenda,Valor_Final, Observa_Cliente) VALUES ('".$TxtCantidad."','".$TxtTalla."','".$TxtTiendaSolicita."','".$TxtTienda."','".$TxtRef."','".$TiempoActual."','".$TiempoActual."','".$IdUser."','".$IdUser."','".$TxtPrecio."','".$For_Costo1."','".$TxtDetalle."')");
//Echo($sql);
$result=$conexion->query($sql);

header("location:OrdenTrasladoCliente.php");

}
 ?>
