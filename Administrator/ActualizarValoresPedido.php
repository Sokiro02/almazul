<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Pedido-Ver.php 


         $TxtValorPrenda=$_POST['TxtValorPrenda'];
         $TxtSolicitud=$_POST['TxtSolicitud'];
         $TxtPedido=$_POST['TxtPedido'];
      

$Valor1=$_POST['demo9'];
$NuevoValor=FormatoMascara($Valor1);


//***********************  Inicio descuento en Referencia  ****************************** 

    if ($NuevoValor<$TxtValorPrenda) {
              
       // $ValorFinalDescuento=$TxtValorPrenda-$NuevoValor;
        // Aplicamos el Descuento a la solicitud
        $sql="UPDATE t_temporal_sol SET Valor_Final='".$NuevoValor."' WHERE Id_Temporal_Sol='".$TxtSolicitud."'";
          //Echo($sql);
          $result=$conexion->query($sql);



        // Verificamos el valor total del Pedido
    $sql="SELECT IFNULL(sum(Valor_Final*Cant_Solicitada),0) as TotalPedido From t_temporal_sol WHERE Pedido_Id_Pedido='".$TxtPedido."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalPedido=$row['TotalPedido'];
    }
}

// Actualizamos el Pedido
 $sql="UPDATE t_pedido SET Total_Pedido='".$TotalPedido."' WHERE Cod_Pedido='".$TxtPedido."'";
          //Echo($sql);
          $result=$conexion->query($sql);

    header("location:Pedido-Ver.php?Solicitud=".$TxtSolicitud."&PedidoCliente=".$TxtPedido."&Mensaje=333");

                  }


 //***********************  Fin descuento en Referencia  ******************************   

               if ($NuevoValor>$TxtValorPrenda) {

                $ValorFinalAdicional=$NuevoValor-$TxtValorPrenda;
                
        // Aplicamos el Descuento a la solicitud
        $sql="UPDATE t_temporal_sol SET Valor_Final='".$NuevoValor."', Valor_Adicional='".$ValorFinalAdicional."' WHERE Id_Temporal_Sol='".$TxtSolicitud."'";
          //Echo($sql);
          $result=$conexion->query($sql);



        // Verificamos el valor total del Pedido
    $sql="SELECT IFNULL(sum(Valor_Final*Cant_Solicitada),0) as TotalPedido From t_temporal_sol WHERE Pedido_Id_Pedido='".$TxtPedido."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalPedido=$row['TotalPedido'];
    }
}

// Actualizamos el Pedido
 $sql="UPDATE t_pedido SET Total_Pedido='".$TotalPedido."' WHERE Cod_Pedido='".$TxtPedido."'";
          //Echo($sql);
          $result=$conexion->query($sql);

    header("location:Pedido-Ver.php?Solicitud=".$TxtSolicitud."&PedidoCliente=".$TxtPedido."&Mensaje=333");


                 }

           if ($NuevoValor==$TxtValorPrenda) {


              // $ValorFinalDescuento=$TxtValorPrenda-$NuevoValor;
        // Aplicamos el Descuento a la solicitud
        $sql="UPDATE t_temporal_sol SET Valor_Final='".$NuevoValor."',Valor_Adicional='0' WHERE Id_Temporal_Sol='".$TxtSolicitud."'";
          //Echo($sql);
          $result=$conexion->query($sql);



        // Verificamos el valor total del Pedido
    $sql="SELECT IFNULL(sum(Valor_Final*Cant_Solicitada),0) as TotalPedido From t_temporal_sol WHERE Pedido_Id_Pedido='".$TxtPedido."'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $TotalPedido=$row['TotalPedido'];
    }
}

// Actualizamos el Pedido
 $sql="UPDATE t_pedido SET Total_Pedido='".$TotalPedido."' WHERE Cod_Pedido='".$TxtPedido."'";
          //Echo($sql);
          $result=$conexion->query($sql);

    header("location:Pedido-Ver.php?Solicitud=".$TxtSolicitud."&PedidoCliente=".$TxtPedido."&Mensaje=333");
           }


          
         
          
          
      
 ?>