<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Recibosdecaja.php
$TxtIdRegistro = $_POST['TxtIdRegistro'];
$TxtNuevaFecha = $_POST['TxtNuevaFecha'];
$TxtBeneficiario = $_POST['TxtBeneficiario'];
$TxtDescripcion = $_POST['TxtDescripcion'];
$SelRubro = $_POST['SelRubro'];
$SelSubrubro= $_POST['SelSubrubro'];

$FechaUno=$_POST['start'];
$FechaDos=$_POST['end'];


$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);


//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_registro_caja SET Valor_Confirmado='".$For_Costo1."' WHERE Id_Registro_Caja='".$TxtIdRegistro."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-Cuadrecaja.php?Mensaje=28&start=".$FechaUno."&end=".$FechaDos."");


 ?>