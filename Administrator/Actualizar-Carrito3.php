<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Config.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$TxtIdVenta = $_POST['TxtIdVenta'];
$TxtCantidad = $_POST['TxtCantidad'];
$TxtRef = $_POST['TxtRef'];

$Valor9=$_POST['demo9'];
$ForCosto9=FormatoMascara($Valor9);

// Consulta Valor de la prenda
$sql ="SELECT PVP_Ref,Cod_Referencia FROM t_referencias WHERE Cod_Referencia='".$TxtRef."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $PVP_Ref=$row['PVP_Ref'];
 }
}

//if ($ForCosto9>$PVP_Ref) {
	//header("location:CrearVenta.php?Mensaje=23");	
	//Echo($PVP_Ref);
//}
//else
//{
	$sql="UPDATE t_salidas_remisiones SET Cant_Solicitada='".$TxtCantidad."', Valor_Final='".$ForCosto9."' WHERE Id_Venta='".$TxtIdVenta."'";
	$result = $conexion->query($sql);
	header("location:CrearRemisionTienda.php?Mensaje=2");	
//}


 ?>

