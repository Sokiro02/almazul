<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
include("Lib/seguridad.php");
$IdUser=$_SESSION['IdUser'];
$Aleaotorio=rand(0,9999);

// Variables de insumos-cargar.php
$IdInventario=$_POST['IdInventario'];
$ActualizarInventario=$_POST['ActualizarInventario'];
$RefAjustada=$_POST['RefAjustada'];
$TiendaSel=$_POST['TiendaSel'];

date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Registro de Actualizaciones
$sql=("INSERT INTO t_ajustes_inventario_ref(Ajuste_Id_Usuario, Fecha_Ajuste, Cant_Ajuste, Referencia_Id_Referencia,Tienda_id_Tienda) VALUES('".$IdUser."','".$DiaActual."','".$ActualizarInventario."','".$RefAjustada."','".$TiendaSel."');");
$result = $conexion->query($sql);


$sql ="UPDATE t_inventario SET Cantidad='".utf8_decode($ActualizarInventario)."' WHERE id='".$IdInventario."'";
$result = $conexion->query($sql);
header("location:VerInventario-Tienda.php?Mensaje=112&QueryCon=".$TiendaSel."");

		
 ?>