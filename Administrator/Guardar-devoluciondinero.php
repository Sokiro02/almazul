<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Recibosdecaja.php


$TxtIdIngreso = $_POST['TxtIdIngreso'];
$TxtIdCliente = $_POST['TxtIdCliente'];
$TxtNuevaFecha = $_POST['TxtNuevaFecha'];
$autorizado = $_POST['autorizado'];
$TxtDetalle = $_POST['TxtDetalle'];
$TxtIdTienda= $_POST['TxtIdTienda'];
$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);
$Valor_Ingreso_Cero=0;
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d H:i:s');


//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_ingresos SET valor_devuelto='".$For_Costo1."', Valor_Ingreso='".$Valor_Ingreso_Cero."' WHERE Id_Ingreso='".$TxtIdIngreso."'");
echo($sql);
$result = $conexion->query($sql);


$sql=("INSERT INTO t_devolucion_dinero(ingreso_id_ingreso, cliente_id_cliente, fecha_devolucion, motivo_devolucion, autoriza_id_usuario, devolucion_id_usuario, valor_devolucion, marca_temporal, tienda_id_tienda) VALUES ('".$TxtIdIngreso."','".utf8_decode($TxtIdCliente)."','".utf8_decode($TxtNuevaFecha)."','".utf8_decode($TxtDetalle)."','".utf8_decode($autorizado)."','".utf8_decode($IdUser)."','".utf8_decode($For_Costo1)."','".utf8_decode($MarcaTemporal)."','".utf8_decode($TxtIdTienda)."')");
echo($sql);
$result = $conexion->query($sql);


header("location:Informe-Ingresos.php?Mensaje=28");


 ?>