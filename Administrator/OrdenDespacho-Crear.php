<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
$Aleaotorio=rand(0,99999);

$TxtCod=$_POST['TxtCod'];

if ($TxtCod!="") {

$TxtConsecutivo=$_POST['TxtConsecutivo'];
$Txtguia=$_POST['Txtguia'];
$TxtTransportadora=$_POST['TxtTransportadora'];
$TxtFechaEnvio=$_POST['TxtFechaSolicitud'];
$TxtPedido=$_POST['TxtPedido'];
// Creo Despacho

$sql="UPDATE t_config SET Cons_Despacho='".$TxtConsecutivo."' WHERE Desarrollador='TEKSYSTEM S.A.S'";
$result=$conexion->query($sql);


//Guardar Insumos Ref 
foreach($_POST['TxtCod'] as $index => $nf) {
    $Codigo=$nf;
    $Cantidad=($_POST['TxtCant'][$index]);
    $EstadoDetalleDespacho=1;
    $EstadoTek=1;

      $sql="INSERT INTO t_detalle_despachos (Despacho_Cod_Despacho, Fecha_Envia_Despacho,  Envia_Id_Usuario, Cant_Enviada, Solicitud_Cliente, Estado_Detalle_Despacho, Transportadora, Publica_Despacho) VALUES('".$TxtConsecutivo."','".$TxtFechaEnvio."','".$IdUser."','".$Cantidad."','".$Codigo."','".$EstadoDetalleDespacho."','".$TxtTransportadora."','".$EstadoTek."')";
      $result=$conexion->query($sql);
      //Echo($sql);
    //Echo($Cantidad." ".$Codigo."<br>");
    //Actualizar Estado en tabla 
      $Estado=1;
      $EstadoSolicitud=8;

      $sql="UPDATE t_temporal_sol SET Estado_Depacho='".$Estado."' WHERE Id_Temporal_Sol='".$Codigo."'";
      $result=$conexion->query($sql);

      $sql="UPDATE t_temporal_sol SET Estado_Solicitud_Cliente='".$EstadoSolicitud."' WHERE Id_Temporal_Sol='".$Codigo."'";
      $result=$conexion->query($sql);


      // Comentario de Envio
$ComentarioAutomatico=utf8_decode("Solicitud Enviada con la remisión  REM".$TxtConsecutivo."");

$sql=("INSERT INTO t_comentarios_produccion_cliente (Usuario_id_usuario, Fecha_Comentario, Comentario_Prod, Solicitud_Cod_Orden) VALUES ('".$IdUser."','".$TiempoActual."','".$ComentarioAutomatico."','".$Codigo."')");
$result = $conexion->query($sql);

      //Echo($sql);
  header("location:Despachos.php?Mensaje=22&OrdenDespacho=".$TxtConsecutivo."");    
}



// Suma de solicitudes en 1 
 $sql="SELECT IFNULL(sum(Estado_Depacho),0) as SumaDespacho FROM t_temporal_sol Where Pedido_Id_Pedido='".$TxtPedido."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $SumaDespacho=$row['SumaDespacho'];
        }
    }
// Suma Total de Solicitudes
 $sql="SELECT COUNT(Estado_Depacho) as TotalSolicitues FROM t_temporal_sol Where Pedido_Id_Pedido='".$TxtPedido."'";
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalSolicitues=$row['TotalSolicitues'];
        }
    }

// Validación y actualización del pedido.

if ($SumaDespacho==$TotalSolicitues) {

$PedidoEnviado=3;

  $sql="UPDATE t_pedido SET Estado_Pedido='".$PedidoEnviado."' WHERE Cod_Pedido='".$TxtPedido."'";
$result = $conexion->query($sql);
}




}
else
{
  header("location:Centro-Distribucion.php?Mensaje=1");
}

 ?>
