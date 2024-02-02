<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];


$TxtNuevaFecha=$_POST['TxtNuevaFecha'];
$TxtTipoFactura=$_POST['TxtTipoFactura'];
$TxtFactura=$_POST['TxtFactura'];



//Actualizar Información de Bodegas
// Datos extraídos de Bodegas.php

$sql=("UPDATE t_facturas SET Fecha_Factura='".utf8_decode($TxtNuevaFecha)."', Factura_Paga='".utf8_encode($TxtTipoFactura)."'  WHERE Num_Factura='".$TxtFactura."'");
echo($sql);
$result = $conexion->query($sql);

header("location:Informe-Facturas.php?Mensaje=2&Fact=".$TxtFactura."");


 ?>