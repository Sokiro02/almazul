<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Recibosdecaja.php
$TxtIdIngreso = $_POST['TxtIdIngreso'];
$TxtNuevaFecha = $_POST['TxtNuevaFecha'];
$TxtMedioPago = $_POST['TxtMedioPago'];
$TxtVoucher = $_POST['TxtVoucher'];



$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);



//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_ingresos SET Valor_Ingreso='".$For_Costo1."',Fecha_Ingreso='".$TxtNuevaFecha."', Medio_Pago='".$TxtMedioPago."', Num_Transaccion='".$TxtVoucher."'  WHERE Id_Ingreso='".$TxtIdIngreso."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-RecibosdeCaja.php?Mensaje=28");


 ?>