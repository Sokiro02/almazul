<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 

$TxtPedido = $_POST['TxtPedido'];
$TxtOrdenNumero = $_POST['TxtOrdenNumero'];
$TxtCantidad=$_POST['TxtCantidad'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$TxtRef=$_POST['TxtRef'];
$TxtBodega=$_POST['TxtBodega'];
$TxtTipoPrenda=$_POST['TxtTipoPrenda'];
$SelectEstado=$_POST['SelectEstado'];
$TxtDetalle=$_POST['TxtDetalle'];
//Actualización de Datos App

// Consulta de la descripción del Estado
 $sql ="SELECT * FROM t_estado_pedidos WHERE Id_Estado_Pedido='".$SelectEstado."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Estado_Pedido=$row['Id_Estado_Pedido'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    $Color_Estado=$row['Color_Estado'];
    $Desc_Estado=$row['Desc_Estado'];
      }
    }

// Cambio de Estado 

date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

$sql="UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='".$SelectEstado."' WHERE Id_Temporal_Sol='".$TxtOrdenNumero."'";
$result = $conexion->query($sql);

$sql="UPDATE t_pedido SET Estado_Pedido='".$SelectEstado."' WHERE Cod_Pedido='".$TxtPedido."'";
$result = $conexion->query($sql);


// Cambio de Estado a Devolución 
if ($SelectEstado==13) {
	
	$sql=("INSERT INTO t_comentarios_produccion_cliente (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".utf8_decode($TxtDetalle)."','".$TxtOrdenNumero."')");
	$result = $conexion->query($sql);

	$sql=("INSERT INTO t_devolucion_ordenes( Pedido_Id_Pedido, Solicitud_Id_Solicitud, Motivo_Dev, Fecha_Devolucion,Reporte_Id_Usuario, Bodega_Id_Bodega) VALUES ('".$TxtPedido."','".$TxtOrdenNumero."','".utf8_decode($TxtDetalle)."','".$DiaActual."','".$IdUser."','".$TxtBodega."')");
	$result = $conexion->query($sql);
}


// Cambio de Estado a Sastre Asignado 

if ($SelectEstado==5) {
	
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
// Consulta Cantidad utilizada por Código  
$sql ="SELECT Cant_Solicitada from t_insumos_ref where Cod_Insumo='".$CadenaInsumos[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$CantInsumo=$row['Cant_Solicitada'];
 }
}
$TotalInsumoDescontado=$CantInsumo*$TxtCantidad;
// Fin de la consulta 
  // Movimiento en inventario de Insumos 
$TipoMovimiento="Retiro Prod.";
$sql=("INSERT INTO t_mov_insumos(Insumo_Cod_Insumo, Bodega_Id_Bodega_Retira, Cant_Mov, Tipo_Mov_Insumo, Solicitud_Id_Solicitud, Usuario_Id_Usuario, Fecha_Solicitud, Fecha_Realizado) VALUES('".$CadenaInsumos[$i]."','".$TxtBodega."','".$TotalInsumoDescontado."','".$TipoMovimiento."','".$TxtOrdenNumero."','".$IdUser."','".$DiaActual."','".$DiaActual."');");
Echo($sql);
$result = $conexion->query($sql);
}

}

// Notificación Timeline

$sql=("INSERT INTO t_comentarios_produccion_cliente (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$DiaActual."','".$Desc_Estado."','".$TxtOrdenNumero."')");
$result = $conexion->query($sql);

$Valida=header("location:Pedido-Ver.php?Solicitud=".$TxtOrdenNumero."&Mensaje=20&Propietario=".$Propietario."&PedidoCliente=".$TxtPedido."");

 ?>