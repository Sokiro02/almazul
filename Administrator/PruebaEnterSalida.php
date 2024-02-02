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

// Variables de  Config.php 
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s');

$RefLectorpost = $_POST['valor'];

$ArregloRef=explode("-", $RefLectorpost);
$Ref=$ArregloRef[0];
$RefTalla=$ArregloRef[1];


$Minimo=1;
$Tienda=$MyIdTienda;


// Consulta Id_Talla
$sql ="SELECT Id_Talla,Nom_Talla FROM t_tallas WHERE Nom_Talla='".$RefTalla."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Talla=$row['Id_Talla'];
      $Nom_TallaLector=$row['Nom_Talla'];
       //Echo($Id_Talla); 
 }
}


// Consulta Referencia de la prenda
$sql ="SELECT Cod_Referencia FROM t_referencias WHERE Cod_Referencia='".$Ref."'"; 

$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Ref=$row['Cod_Referencia'];
     
 }
}


// Consulta Valor de la prenda
$sql ="SELECT PVP_Ref,Cod_Referencia FROM t_referencias WHERE Cod_Referencia='".$Ref."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $PVP_Ref=$row['PVP_Ref'];
 }
}


if ($PVP_Ref=="") { // Si no hay valor = Referencia solicittada no exise
  header("location:CrearRemisionTienda.php?Mensaje=21"); 
}
else{

$sql ="SELECT Referencia_Id_Referencia,Nom_Talla FROM t_ventas as A, t_tallas as B WHERE Referencia_Id_Referencia='".$Ref."'and A.Talla_Solicitada=B.Id_Talla and Factura_Id_Factura='0'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $RefTabla=$row['Referencia_Id_Referencia'];
      $TallaTabla=$row['Nom_Talla'];
      $RefCompleta=$RefTabla."-".$TallaTabla;
 }
}

//if ($RefCompleta==$RefLector ) {
  //header("location:CrearVenta.php?Mensaje=22");
//}
if ($Id_Talla=="") {
 header("location:CrearRemisionTienda.php?Mensaje=21");
}
else
  {
    $EstadoVenta=1;
    $RefLector=$Ref."-".$Nom_TallaLector;

     $sql ="SELECT Cantidad FROM t_inventario  WHERE Referencia_Completa='".$RefLector."' and Id_Tienda='".$Tienda."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $CantidadInventario=$row['Cantidad'];
 }
}

if ($CantidadInventario>0) {
    $sql="INSERT INTO t_salidas_remisiones (Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia,Ref_Vendida, Fecha_Solicitud, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final,Estado_Venta) VALUES ('".$Minimo."','".$Id_Talla."','".$Tienda."','".$Ref."','".$RefLector."','".$TiempoActual."','".$IdUser."','".$PVP_Ref."','".$PVP_Ref."','".$EstadoVenta."')";
//Echo($sql)
$result = $conexion->query($sql);

header("location:CrearRemisionTienda.php");
}

  else
  {
      header("location:CrearRemisionTienda.php?Mensaje=222");
  }


  }
}


 ?>

