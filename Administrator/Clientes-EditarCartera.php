<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];

// Variables de  Informe-Recibosdecaja.php
$TxtFactura = $_POST['TxtFactura'];
$TxtFechaCartera = $_POST['TxtFechaCartera'];
$TxtCliente = $_POST['TxtCliente'];
$TxtTienda = $_POST['TxtTienda'];



$Valor1=$_POST['demo1'];
$For_Costo1=FormatoMascara($Valor1);



//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_cartera SET Valor_Cartera='".$For_Costo1."',Fecha_Cartera='".$TxtFechaCartera."', Cliente_Id_Cliente='".$TxtCliente."', Tienda_Id_Tienda='".$TxtTienda."'  WHERE Id_Cartera='".$TxtFactura."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-Cartera.php?Mensaje=28");


 ?>