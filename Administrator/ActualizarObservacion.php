<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Pedido-Ver.php 


         $TxtDetalle=$_POST['TxtDetalle'];
         $TxtSolicitud=$_POST['TxtSolicitud'];
         $TxtPedido=$_POST['TxtPedido'];
         $TxtUsuarioObserva=$_POST['TxtUsuarioObserva'];

         date_default_timezone_set("America/Bogota");
          $FechaActualizacionObserva = date('Y-m-d H:i:s');

          $sql="UPDATE t_temporal_sol SET Observa_Cliente='".$TxtDetalle."',Fecha_Observacion='".$FechaActualizacionObserva."',Observa_Id_Usuario='".$TxtUsuarioObserva."' WHERE Id_Temporal_Sol='".$TxtSolicitud."'";
          //Echo($sql);
          $result=$conexion->query($sql);

          // Informa actualización a producción

          $EstadoInforma=1;
          $sql="INSERT INTO t_actualizacion_ordenes(Actualiza_Id_Usuario, Fecha_Actualiza, Comentario_Actualiza, SolTem_Id_Solicitud, Pedido_Id_Pedido,Estado_Actualiza) VALUES ('".$TxtUsuarioObserva."','".$FechaActualizacionObserva."','".$TxtDetalle."','".$TxtSolicitud."','".$TxtPedido."','".$EstadoInforma."')";
          $result=$conexion->query($sql);
          
          header("location:Pedido-Ver.php?Solicitud=".$TxtSolicitud."&PedidoCliente=".$TxtPedido."&Mensaje=33");
          
          
      
 ?>