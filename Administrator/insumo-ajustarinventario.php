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
$CodInsumo=$_POST['CodInsumo'];

date_default_timezone_set("America/Bogota");
$DiaActual = date('Y-m-d H:i:s');

// Registro de Actualizaciones
$sql=("INSERT INTO t_ajustes_inventario_telas(Ajuste_Id_Usuario, Fecha_Ajuste, Cant_Ajuste, Cod_Insumo_Cod) VALUES('".$IdUser."','".$DiaActual."','".$ActualizarInventario."','".$CodInsumo."');");
$result = $conexion->query($sql);


$sql ="UPDATE t_inventario_telas SET Cantidad_Inv='".utf8_decode($ActualizarInventario)."' WHERE Id_Inventario_tela='".$IdInventario."'";
$result = $conexion->query($sql);
header("location:insumos-cargar.php?Mensaje=112&CodInsumo=".$CodInsumo."");

		
 ?>