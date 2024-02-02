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

// Variables de  CrearVenta.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$SeparadoNumero=$_GET['NumeroFactura'];


// CONSULTAR EL NÚMERO DE CONSECUTIVO
$sql ="SELECT Consecutivo_Factura FROM t_config_tienda WHERE Tienda_Id_Tienda='".$MyIdTienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Consecutivo_Factura=$row['Consecutivo_Factura']+1;
    }
  }

// Consulta Datos de la factura a Tabla Separados
$sql ="SELECT Fecha_Separe, Num_Separe, Cliente_Id_Cliente, Subtotal_Separe, Iva_Separe, Total_Separe, Estado_Separe,Separe_Paga, Tienda_Id_Tienda FROM t_separados WHERE Num_Separe='".$SeparadoNumero."'";  
Echo($sql);
    $result = $conexion->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
        $Fecha_Separe=$row['Fecha_Separe'];                
        $Num_Separe=$row['Num_Separe'];  
        $Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];  
        $Subtotal_Separe=$row['Subtotal_Separe'];  
        $Iva_Separe=$row['Iva_Separe'];  
        $Total_Separe=$row['Total_Separe'];  
        $Estado_Separe=$row['Estado_Separe'];  
        $Separe_Paga=$row['Separe_Paga'];  
        $Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];  
        }
    }

// ACTUALIZAR EL ESTADO AL PLAN SEPARE
    $EstadoSalidaSeparado=3;

$sql=("UPDATE t_separados SET Separe_Paga='".$EstadoSalidaSeparado."' WHERE Num_Separe='".$SeparadoNumero."';");
//echo($sql);
$result = $conexion->query($sql);

// ACTUALIZAR LOS ABONOS CON EL NÚMERO DE FACTURA

$sql=("UPDATE t_ingresos SET Factura_Cod_Factura='".$Consecutivo_Factura."' WHERE separe_cod_separe='".$SeparadoNumero."';");
//echo($sql);
$result = $conexion->query($sql);

//Echo("<br>*************************** Crear Factura ************+");

//Se crea  la factura de Venta
$EstadoFactura=1; // Confirmada
$TxtTipoVenta=1; // De Contado

$sql=("INSERT INTO t_facturas (Fecha_Factura, Num_Factura, Cliente_Id_Cliente, Subtotal_Factura, Iva_Factura, Total_Factura, Estado_Factura,Factura_Paga, Marca_Temporal, Usuario_Vendedor, Tienda_Id_Tienda) VALUES ('".utf8_decode($TiempoActual)."','".utf8_decode($Consecutivo_Factura)."','".utf8_decode($Cliente_Id_Cliente)."','".utf8_decode($Subtotal_Separe)."','".utf8_decode($Iva_Separe)."','".utf8_decode($Total_Separe)."','".utf8_decode($EstadoFactura)."','".utf8_decode($TxtTipoVenta)."','".utf8_decode($TiempoActual)."','".utf8_decode($IdUser)."','".utf8_decode($MyIdTienda)."')");
//echo($sql);
$result = $conexion->query($sql);

//Echo("<br>*************************** Actualiza Consecutivo Factura ************+");

$sql=("UPDATE t_config_tienda SET Consecutivo_Factura='".$Consecutivo_Factura."' WHERE Tienda_Id_Tienda='".$MyIdTienda."';");
//echo($sql);
$result = $conexion->query($sql);



// ************** Arreglo Total PlanSepare ***************//
$sql ="SELECT Id_Venta FROM t_plansepare WHERE Factura_Id_Factura='".$SeparadoNumero."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
$Lista=$Lista.$row['Id_Venta'].",";                  
 }
}
$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;
// ************** Arreglo Total Insumos ***************//

for($i=0; $i<$min; $i++)
{

$sql ="SELECT Cant_Solicitada,Talla_Solicitada,Tienda_Id_Tienda,Referencia_Id_Referencia,Ref_Vendida,Vendedor_Id_Usuario,Valor_Prenda,Valor_Final,Cliente_Id_Cliente, Factura_Id_Factura FROM t_plansepare WHERE Id_Venta='".$Cadena[$i]."'";  
    $result = $conexion->query($sql);
    //Echo($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
        $Cant_Solicitada=$row['Cant_Solicitada'];                
        $Talla_Solicitada=$row['Talla_Solicitada'];  
        $Tienda_Id_Tienda=$row['Tienda_Id_Tienda'];  
        $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];  
        $Ref_Vendida=$row['Ref_Vendida'];  
        $Vendedor_Id_Usuario=$row['Vendedor_Id_Usuario'];  
        $Valor_Prenda=$row['Valor_Prenda'];  
        $Valor_Final=$row['Valor_Final'];  
        $Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];  
        $Factura_Id_Factura=$row['Factura_Id_Factura']; 
        }
    } 

$CambiaVenta=3;
$sql=("UPDATE t_plansepare SET Estado_Venta='".$CambiaVenta."' WHERE Id_Venta='".$Cadena[$i]."';");
//echo($sql);
$result = $conexion->query($sql);


//Echo("<br>*************************** Insertar Ventas ************+");
// Insertar Ventas en Tabla Ventas.
$EstadoVenta=2;

$sql=("INSERT INTO t_ventas (Cant_Solicitada,Talla_Solicitada,Tienda_Id_Tienda,Referencia_Id_Referencia,Ref_Vendida,Fecha_Solicitud,Vendedor_Id_Usuario,Valor_Prenda,Valor_Final,Cliente_Id_Cliente,Factura_Id_Factura,Estado_Venta) VALUES ('".utf8_decode($Cant_Solicitada)."','".utf8_decode($Talla_Solicitada)."','".utf8_decode($Tienda_Id_Tienda)."','".utf8_decode($Referencia_Id_Referencia)."','".utf8_decode($Ref_Vendida)."','".utf8_decode($TiempoActual)."','".utf8_decode($Vendedor_Id_Usuario)."','".utf8_decode($Valor_Prenda)."','".utf8_decode($Valor_Final)."','".utf8_decode($Cliente_Id_Cliente)."','".utf8_decode($Consecutivo_Factura)."','".$EstadoVenta."')");
//echo($sql);
$result = $conexion->query($sql);


}


 header("location:Informe-VentasTienda.php?Mensaje=3");

 ?>

