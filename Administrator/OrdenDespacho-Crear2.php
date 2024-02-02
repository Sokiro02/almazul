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
// Creo Despacho

$sql="UPDATE t_config SET Cons_Despacho='".$TxtConsecutivo."' WHERE Desarrollador='TEKSYSTEM S.A.S'";
$result=$conexion->query($sql);

//Guardar Insumos Ref 
foreach($_POST['TxtCod'] as $index => $nf) {
    $Codigo=$nf;
    $Cantidad=($_POST['TxtCant'][$index]);
    $EstadoDetalleDespacho=1;
    $EstadoTek=1;

      $sql="INSERT INTO t_detalle_despachos (Despacho_Cod_Despacho, Fecha_Envia_Despacho,  Envia_Id_Usuario, Cant_Enviada, Solicitud_Produccion, Estado_Detalle_Despacho, Transportadora, Publica_Despacho) VALUES('".$TxtConsecutivo."','".$TxtFechaEnvio."','".$IdUser."','".$Cantidad."','".$Codigo."','".$EstadoDetalleDespacho."','".$TxtTransportadora."','".$EstadoTek."')";
      $result=$conexion->query($sql);
      //Echo($sql);
    //Echo($Cantidad." ".$Codigo."<br>");
    //Actualizar Estado en tabla 
      $Estado=1;
      $EstadoSolicitud=10;

      $sql="UPDATE t_solicitudes_prod SET Estado_Solicitud_Prod='".$EstadoSolicitud."' WHERE Cod_Solicitud_Prod='".$Codigo."'";
      $result=$conexion->query($sql);

      //Echo($sql);
  header("location:Despachos.php?Mensaje=22&OrdenDespacho=".$TxtConsecutivo."");    
}

}
else
{
  header("location:Centro-Distribucion.php?Mensaje=1");
}

 ?>
