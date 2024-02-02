<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Recibosdecaja.php
$TxtIdIngreso = $_POST['TxtIdIngreso'];
$TxtNuevoReciboCaja = $_POST['TxtNuevoReciboCaja'];
$Concepto="ABONO A PEDIDO N. ".$TxtNuevoReciboCaja."";

//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_ingresos SET Pedido_Id_Pedido='".utf8_decode($TxtNuevoReciboCaja)."',Concepto_Ingreso='".$Concepto."'  WHERE Id_Ingreso='".$TxtIdIngreso."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-RecibosdeCaja.php?Mensaje=27&OrdenSeleccionado=".$TxtNuevoReciboCaja."");


 ?>