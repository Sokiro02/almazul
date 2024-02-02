<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Recibosdecaja.php
$TxtIdGasto = $_POST['TxtIdGasto'];
$TxtNuevaFecha = $_POST['TxtNuevaFecha'];
$TxtBeneficiario = $_POST['TxtBeneficiario'];
$TxtDescripcion = $_POST['TxtDescripcion'];
$SelRubro = $_POST['SelRubro'];
$SelSubrubro= $_POST['Sel_Sub_Rubro'];

$FechaUno=$_POST['start'];
$FechaDos=$_POST['end'];


$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);


//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_gastos SET Valor_gasto='".$For_Costo1."',Fecha_Gasto='".$TxtNuevaFecha."', Beneficiario='".$TxtBeneficiario."', Descripcion='".$TxtDescripcion."', Rubro_Id_Rubro='".$SelRubro."', Sub_rubro='".$SelSubrubro."'  WHERE Id_gasto='".$TxtIdGasto."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-GastosTienda.php?Mensaje=28&start=".$FechaUno."&end=".$FechaDos."");


 ?>