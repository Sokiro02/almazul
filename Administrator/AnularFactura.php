<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];

// Variables de  Clientes-AnularFactura.php 

$FacturaNumero = $_POST['FacturaNumero'];
$Detalle = htmlentities($_POST['TxtDetalle']);

date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');


// Consulta datos de la venta
$sql ="SELECT * FROM t_facturas  WHERE Num_Factura='".$FacturaNumero."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Subtotal_Factura=$row['Subtotal_Factura'];
        $Iva_Factura=$row['Iva_Factura'];
        $Total_Factura=$row['Total_Factura'];
    }
}

$SubtotalNegativo=$Subtotal_Factura*-1;
$IvaNegativo=$Iva_Factura*-1;
$TotalNegativo=$Total_Factura*-1;


$EstadoAnulado=3;

$sql ="UPDATE t_facturas SET Subtotal_Factura='".$SubtotalNegativo."', Iva_Factura='".$IvaNegativo."', Total_Factura='".$TotalNegativo."', Observa_Factura='".$Detalle."', Usuario_Anula='".$IdUser."', Fecha_Anula='".$TiempoActual."', Factura_Paga='".$EstadoAnulado."' WHERE Num_Factura='".$FacturaNumero."'";  
//Echo($sql);
$result = $conexion->query($sql);


$sql ="SELECT Id_Ingreso FROM t_ingresos WHERE Factura_Cod_Factura='".$FacturaNumero."'";
	$result = $conexion->query($sql);
	if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
	$Lista=$Lista.$row['Id_Ingreso'].",";                  
 }
}

$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;

for($i=0; $i<$min; $i++)
{
	$sql ="SELECT Valor_Ingreso FROM t_ingresos  WHERE Id_Ingreso='".$Cadena[$i]."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Valor_Ingreso_Negativo=$row['Valor_Ingreso']*-1;
    }
}

$sql ="UPDATE t_ingresos SET Valor_Ingreso='".$Valor_Ingreso_Negativo."' WHERE Id_Ingreso='".$Cadena[$i]."';";  
//Echo($sql);
$result = $conexion->query($sql);


}



header("location:Clientes-AnularFactura.php?Mensaje=222&NumeroFactura=".$FacturaNumero."");
 ?>