<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");

$IdUser=$_SESSION['IdUser'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');
// Variables de  OrdenCliente.php 


// Consecutivo Pedidos de Cliente
$sql ="SELECT Cons_PedidosCl FROM t_config WHERE Desarrollador='TEKSYSTEM S.A.S'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $TxtConsecutivoPedido=$row['Cons_PedidosCl']+1;
 }
}

$TxtConsecutivoReciboCaja=$_POST['TxtConsecutivoReciboCaja'];
$TxtTienda=$_POST['TxtTienda'];
$TxtTaller=$_POST['TxtTaller'];
$TxtCliente=$_POST['TxtClientes'];
$TxtFechaEntrega=$_POST['TxtFechaEntrega'];
$TxtSumaPedido=$_POST['TxtSumaPedido'];
$SumaAbono=$_POST['SumaAbono'];
$EstadoIngreso=1; // Confirmado
$EstadoTekMaster=1;
$EstadoIngreso=1; // Confirmado


if ($TxtSumaPedido==0) {
	header("location:CrearCliente.php?ClientePedido=".$TxtCliente."&Mensaje=22");
}
else
{

// Registro Pedido

$sql=("INSERT INTO t_pedido(Cod_Pedido, Cliente_Id_Cliente, Fecha_Pedido, Total_Pedido, Estado_Pedido, Saldo_Abonado, Pedido_Id_Usuario, Fecha_Entrega,Tienda_Id_Tienda,taller_id_taller) VALUES ('".utf8_decode($TxtConsecutivoPedido)."','".utf8_decode($TxtCliente)."','".utf8_decode($TiempoActual)."','".utf8_decode($TxtSumaPedido)."','".utf8_decode($EstadoTekMaster)."','".utf8_decode($SumaAbono)."','".utf8_decode($IdUser)."','".utf8_decode($TxtFechaEntrega)."','".utf8_decode($TxtTienda)."','".$TxtTaller."')");
echo($sql);
$result = $conexion->query($sql);

		
foreach($_POST['TxtIdIngreso'] as $index => $nf) {
    $Codigo=$nf;
    $ConceptoVenta=utf8_decode("ANTICIPO A PEDIDO  PDC".$TxtConsecutivoPedido."");
    

 $sql=("UPDATE t_ingresos SET Estado_Ingreso='1', Pedido_Id_Pedido='".$TxtConsecutivoPedido."', Concepto_Ingreso='".$ConceptoVenta."' WHERE Id_Ingreso='".$Codigo."' ");

echo($sql);
$result = $conexion->query($sql);

		}


// Actualización del Consecutivo de Pedidos
$sql=("UPDATE t_config SET Cons_PedidosCl='".$TxtConsecutivoPedido."' WHERE Desarrollador='TEKSYSTEM S.A.S'");
echo($sql);
$result = $conexion->query($sql);



// Actualización de las solicitudes de producción

$UsuarioCero=0; // Se cambia a cero Solicitud_Id_Usuario para uqe no aparezca como una orden pendiente en alertas.
$EstadoInicial=1; // Lista de Espera


$sql=("UPDATE t_temporal_sol SET Vendedor_Id_Usuario='".$IdUser."', Cliente_Id_Cliente='".$TxtCliente."',Pedido_Id_Pedido='".$TxtConsecutivoPedido."',Fecha_Entrega='".$TxtFechaEntrega."',Estado_Solicitud_Cliente='".$EstadoInicial."',bodega_id_bodega='".$TxtTaller."' WHERE Solicitud_Id_Usuari='".$IdUser."'");
echo($sql);
$result = $conexion->query($sql);

$sql=("UPDATE t_temporal_sol SET Solicitud_Id_Usuari='".$UsuarioCero."' WHERE Solicitud_Id_Usuari='".$IdUser."'");
echo($sql);
$result = $conexion->query($sql);

$sql=("DELETE FROM ingreso_temporal_usuario WHERE Usuario_Ingreso='".$IdUser."' and Pago_De='Orden';");
echo($sql);
$result = $conexion->query($sql);


// Bucle para conocer las referencias solicitadas
$sql ="SELECT Id_Temporal_Sol FROM t_temporal_sol WHERE Pedido_Id_Pedido='".$TxtConsecutivoPedido."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ListaReferencias=$ListaReferencias.$row['Id_Temporal_Sol'].",";                  
 }
}
$CadenaRef=explode(",", $ListaReferencias);
//Split al Arreglo
$longitud = count($CadenaRef);
$min=$longitud-1;
//Recorro todos los elementos

for($i=0; $i<$min; $i++)
{

$sql ="SELECT Referencia_Id_Referencia FROM t_temporal_sol WHERE Id_Temporal_Sol='".$CadenaRef[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$ReferenciaSol=$row['Referencia_Id_Referencia'];                  
 }
}

$sql ="SELECT Cant_Solicitada FROM t_temporal_sol WHERE Id_Temporal_Sol='".$CadenaRef[$i]."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$SolicitadaSol=$row['Cant_Solicitada'];                  
 }
}

BucleDescuentoInsumos($ReferenciaSol,$SolicitadaSol,$TxtTaller);

}



//header("location:Pdf_ReciboCaja.php?ReciboCajaImp=".$TxtConsecutivoReciboCaja."&PedidoImp=".$TxtConsecutivoPedido."");
header("location:Pedidos.php?Mensaje=123");
}

 ?>