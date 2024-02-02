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

// if (strpos($RefLectorpost, "'") !== false) {

//     $RefLector=str_replace("'", "-", $RefLectorpost);
    
// }
// else
// {
//   $RefLector=$RefLectorpost;
// }

$codigo_ref1=substr($RefLectorpost,0,9);
$codigo_ref2=substr($RefLectorpost,9,3);

//$ArregloRef=explode("-", $RefLector);
//$Ref=$ArregloRef[0];
//$RefTalla=$ArregloRef[1];
$Minimo=1;
$Tienda=$MyIdTienda;


// Consulta Id_Talla
$sql ="SELECT Id_Talla,Nom_Talla FROM t_tallas WHERE Id_Talla='".$codigo_ref2."'";  
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {   
      $Id_Talla=$row['Id_Talla'];
      $Nom_TallaLector=$row['Nom_Talla'];
       //Echo($Id_Talla); 
 }
}


// Consulta Referencia de la prenda
$sql ="SELECT Cod_Referencia FROM t_referencias WHERE Cod_Referencia LIKE '%".$codigo_ref1."%'"; 

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
  header("location:CrearVenta.php?Mensaje=21"); 
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


if ($Id_Talla=="") {
 header("location:CrearVenta.php?Mensaje=21");
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


if ($MyIdTienda==9) {
   $sql="INSERT INTO t_ventas (Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia,Ref_Vendida, Fecha_Solicitud, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final,Estado_Venta) VALUES ('".$Minimo."','".$Id_Talla."','".$Tienda."','".$Ref."','".$RefLector."','".$TiempoActual."','".$IdUser."','".$PVP_Ref."','".$PVP_Ref."','".$EstadoVenta."')";
$result = $conexion->query($sql);
//Echo($sql);
header("location:CrearVenta.php");
}else{


  

if ($CantidadInventario>0) {
  $sql="INSERT INTO t_ventas (Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia,Ref_Vendida, Fecha_Solicitud, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final,Estado_Venta) VALUES ('".$Minimo."','".$Id_Talla."','".$Tienda."','".$Ref."','".$RefLector."','".$TiempoActual."','".$IdUser."','".$PVP_Ref."','".$PVP_Ref."','".$EstadoVenta."')";
$result = $conexion->query($sql);
//Echo($sql);
header("location:CrearVenta.php");
}

else
{
  //$sql="INSERT INTO t_ventas (Cant_Solicitada, Talla_Solicitada, Tienda_Id_Tienda, Referencia_Id_Referencia,Ref_Vendida, Fecha_Solicitud, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final,Estado_Venta) VALUES ('".$Minimo."','".$Id_Talla."','".$Tienda."','".$Ref."','".$RefLector."','".$TiempoActual."','".$IdUser."','".$PVP_Ref."','".$PVP_Ref."','".$EstadoVenta."')";
//$result = $conexion->query($sql);
//Echo($sql);
  //header("location:CrearVenta.php");
  header("location:CrearVenta.php?Mensaje=222");
}
}

  }
}


 ?>

