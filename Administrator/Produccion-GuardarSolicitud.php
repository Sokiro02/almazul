<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

// Consulta Usuario Responsable
$sql ="SELECT Nombres,Apellidos from t_usuarios WHERE Id_Usuario='".$IdUser."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nombres=$row['Nombres'];
$Apellidos=$row['Apellidos'];
 }
}

 $sql="SELECT Cons_Orden_Prod FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";
  $result=$conexion->query($sql);
  if ($result->num_rows >0) {
    while ($row = $result->fetch_assoc ()) {
      $UltimaSolicitud=$row['Cons_Orden_Prod']+1;
    }
  }
// Fin de la consulta 



$TxtCantidad=$_POST['TxtCantidad'];
$TxtCantidadEspera=$_POST['TxtCantidadEspera'];


if ($TxtCantidad!="") {

// Recibir Variables
	$TxtBodega=$_POST['TxtBodega'];
	$TxtTalla=$_POST['TxtTalla'];
	$TxtAlmacen=$_POST['TxtTienda'];

// Consulta Nombre Talla
$sql ="SELECT Nom_Talla from t_tallas WHERE Id_Talla='".$TxtTalla."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nom_Talla=$row['Nom_Talla'];
 }
}
// Fin de la consulta 


$TxtRef=$_POST['TxtRef'];
$EstadoSolicitud=1;

//$UltimaSolicitud=$_POST['TxtConsecutivoSolicitud'];

// Guardar Solicitud 
$sql=("INSERT INTO t_solicitudes_prod(Cod_Solicitud_Prod,Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Prod, Fecha_Solicitud, Solicitud_Id_Usuario) VALUES ('".$UltimaSolicitud."','".$TxtBodega."','".$TxtCantidad."','".$TxtTalla."','".$TxtAlmacen."','".$TxtRef."','".$EstadoSolicitud."','".$TiempoActual."','".$IdUser."')");
Echo($sql);
$result=$conexion->query($sql);

// Actualizar Consecutivo 
$sql=("UPDATE t_config SET Cons_Orden_Prod='".$UltimaSolicitud."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
//Echo($sql);
$result=$conexion->query($sql);

// Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$TxtRef."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos=$ListaInsumos.$row['Cod_Insumo'].",";                  
 }
}
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud = count($CadenaInsumos);
$min=$longitud-1;
//Recorro todos los elementos


// Envio Notificaciones  
$sql ="SELECT Id_Usuario FROM t_usuarios";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaUser=$ListaUser.$row['Id_Usuario'].",";              
 }
}
$CadenaUser=explode(",", $ListaUser);
//Split al Arreglo
$longitud2 = count($CadenaUser);
$min2=$longitud2-1;
//Recorro todos los elementos

for($i=0; $i<$min2; $i++)
{
	$Mensaje=("Not. Producción ".$Nombres." ".$Apellidos."");
	$EstadoMensaje=1;
	$NotificaLeido=1;

		$sql=("INSERT INTO t_notificaciones_push(Usuario_Id_Usuario_Envia, Usuario_Id_Usuario_Recibe, Mensaje_Push, Fecha_Mensaje_Push, Estado_Mensaje_Push, Leido_Mensaje_Push) VALUES ('".$IdUser."','".$CadenaUser[$i]."','".$Mensaje."','".$TiempoActual."','".$EstadoMensaje."','".$NotificaLeido."');");
		$result = $conexion->query($sql);
}

// Primera Notificación de Producción
$PrimerComentario=utf8_decode("Confeccionar ".$TxtCantidad." Un. de la Referencia: ".$TxtRef." de la talla: ".$Nom_Talla."");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$TiempoActual."','".$PrimerComentario."','".$UltimaSolicitud."')");
$result = $conexion->query($sql);

header("location:Produccion-Solicitud.php?Mensaje=1&RefSel=".$TxtRef."");
}


//*****************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************

else if ($TxtCantidadEspera!="")
{


// Recibir Variables
	$TxtBodega=$_POST['TxtBodega'];
	$TxtTalla=$_POST['TxtTalla'];
	$TxtAlmacen=$_POST['TxtTienda'];

// Consulta Nombre Talla
$sql ="SELECT Nom_Talla from t_tallas WHERE Id_Talla='".$TxtTalla."' ";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Nom_Talla=$row['Nom_Talla'];
 }
}
// Fin de la consulta 


$TxtRef=$_POST['TxtRef'];
$EstadoSolicitud=1;
//$UltimaSolicitud=$_POST['TxtConsecutivoSolicitud'];

// Guardar Solicitud 
$sql=("INSERT INTO t_solicitudes_prod(Cod_Solicitud_Prod,Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia, Estado_Solicitud_Prod, Fecha_Solicitud, Solicitud_Id_Usuario) VALUES ('".$UltimaSolicitud."','".$TxtBodega."','".$TxtCantidadEspera."','".$TxtTalla."','".$TxtAlmacen."','".$TxtRef."','".$EstadoSolicitud."','".$TiempoActual."','".$IdUser."')");
Echo($sql);
$result=$conexion->query($sql);

// Actualizar Consecutivo 
$sql=("UPDATE t_config SET Cons_Orden_Prod='".$UltimaSolicitud."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
//Echo($sql);
$result=$conexion->query($sql);


// Primera Notificación de Producción
$PrimerComentario=utf8_decode("Confeccionar  ".$TxtCantidadEspera." Un. de la Referencia: ".$TxtRef."  talla: ".$Nom_Talla."para curva de producción");

$sql=("INSERT INTO t_comentarios_produccion (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$TiempoActual."','".$PrimerComentario."','".$UltimaSolicitud."')");
$result = $conexion->query($sql);


// Descuento de Inventario de Insumos

// Bucle para conocer los codigos que se requieren para el producto 
$sql ="SELECT Cod_Insumo FROM t_insumos_ref WHERE Referencia_Cod_Referencia='".$TxtRef."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaInsumos=$ListaInsumos.$row['Cod_Insumo'].",";                  
 }
}
$CadenaInsumos=explode(",", $ListaInsumos);
//Split al Arreglo
$longitud = count($CadenaInsumos);
$min=$longitud-1;
//Recorro todos los elementos

for($i=0; $i<$min; $i++)
{
	$IdValledupar=5;
date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Consulta Cantidad utilizada por Código  
$sql ="SELECT Cant_Solicitada from t_insumos_ref where Cod_Insumo='".$CadenaInsumos[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$CantInsumo=$row['Cant_Solicitada'];
 }
}
$TotalInsumoDescontado=round($CantInsumo,1)*$TxtCantidadEspera; // Valor total a descontar
$TotalInsumoDescontadoNegativo=round($TotalInsumoDescontado*-1,1); // Valor total a descontar en caso que no esté el insumo en inventario.

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Cod_Insumo_Cod FROM t_inventario_telas WHERE Cod_Insumo_Cod='".$CadenaInsumos[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$VerificarInsumo=$row['Cod_Insumo_Cod']; 
 }
}

// Consulta Saber si el código está en el inventario 
$sql ="SELECT Id_Insumo,Unidad_Insumo FROM t_insumos WHERE Cod_Insumo='".$CadenaInsumos[$i]."' and Subcategoria_Id_Subcategoria_Insumo<>'0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$TxtIdInsumo=$row['Id_Insumo'];
$Qr_Unidad_Insumo=$row['Unidad_Insumo']; 
 }
}


	if ($VerificarInsumo!="") {
		$SqlActualizar ="UPDATE t_inventario_telas SET Cantidad_Inv=Cantidad_Inv-'".round($TotalInsumoDescontado,1)."' WHERE Cod_Insumo_Cod='".$CadenaInsumos[$i]."'"; //ACTUALIZAMOS EL INVENTARIO
        $ResultActualizar = $conexion->query($SqlActualizar)or die (mysqli_error($conexion));
		}
	else
	{
		$sql=("INSERT INTO t_inventario_telas(taller_id_taller, Insumo_Id_Insumo, Cod_Insumo_Cod, Cantidad_Inv, Medida_Inv, Fecha_Ingreso, Responsable_Id_Usuario) VALUES('".$IdValledupar."','".$TxtIdInsumo."','".$CadenaInsumos[$i]."','".round($TotalInsumoDescontadoNegativo,1)."','".$Qr_Unidad_Insumo."','".$DiaActual."','".$IdUser."');");
			//Echo($sql);
			$result = $conexion->query($sql);

	}



}




header("location:Produccion-Solicitud.php?Mensaje=1&RefSel=".$TxtRef."");

}



 ?>
